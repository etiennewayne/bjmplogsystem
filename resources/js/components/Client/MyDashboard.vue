<template>
<div>

    <div class="section">
        <div class="columns">
            <div class="column is-6 is-offset-3">
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img v-if="user.img_path" class="cover" :src="`/storage/imgs/${user.img_path}`">
                            <b-loading v-else :is-full-page="false" :can-cancel="true"></b-loading>
                        </figure>
                    </div>
                    <div class="card-content">
                        <hr>
                        <div class="">
                            <p class="title is-4">{{user.fname}} {{user.mname}} {{ user.lname }}</p>
                            <p class="subtitle is-6">@{{ user.username }}</p>
                        </div>

                        <div class="content">
                           <p><b-icon icon="map-marker"></b-icon>{{ user.street }} {{ user.brgyDesc }}, {{ user.citymunDesc }}, {{user.provDesc}}</p>
                        </div>

                        <div class="buttons mt-4">
                            <b-button icon-left="qrcode" @click="openModalQR" class="button">SHOW QR</b-button>
                            <b-button icon-left="account-edit-outline" @click="openModalProfile" class="button">EDIT PROFILE</b-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--modal create-->
        <b-modal v-model="isQRModal" has-modal-card
                 trap-focus
                 :width="640"
                 aria-role="dialog"
                 aria-label="Modal"
                 aria-modal>


            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">QR Code</p>
                    <button
                        type="button"
                        class="delete"
                        @click="isQRModal = false"/>
                </header>

                <section class="modal-card-body">
                    <div class="">
                        <div class="columns">
                            <div class="column">
                                <div class="qr-container">
                                    <div>QR CODE: {{user.qr_ref }}</div>
                                    <div>
                                        <qrcode :value="user.qr_ref" :options="{ width: 200 }"></qrcode>
                                    </div>
                                    <div>
                                        <b>NAME: </b>{{user.lname}}, {{ user.fname}} {{ user.mname }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <b-button
                        label="Close"
                        @click="isQRModal=false"/>
                </footer>
            </div>

        </b-modal>
        <!--close modal-->



        <!--modal create-->
        <b-modal v-model="isModalProfile" has-modal-card
                 trap-focus
                 :width="640"
                 aria-role="dialog"
                 aria-label="Modal"
                 aria-modal>


            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Profile Information</p>
                    <button
                        type="button"
                        class="delete"
                        @click="isModalProfile = false"/>
                </header>

                <section class="modal-card-body">
                    <div class="container">

                        <form action="">
                            <div class="columns">

                                <div class="column">
                                    <b-field label="Last Name" label-position="on-border"
                                        :type="this.errors.lname ? 'is-danger':''"
                                        :message="this.errors.lname ? this.errors.lname[0] : ''">
                                        <b-input v-model="fields.lname" placholder="Last Name" />
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="First Name" label-position="on-border">
                                        <b-input v-model="fields.fname" placholder="First Name" />
                                    </b-field>
                                </div>
                                
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Middle Name" label-position="on-border">
                                        <b-input v-model="fields.mname" placholder="Middle Name" />
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Suffix" label-position="on-border">
                                        <b-input v-model="fields.suffix" placholder="Suffix" />
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Sex" expanded label-position="on-border">
                                        <b-select v-model="fields.sex" placholder="Sex" expanded>
                                            <option value="MALE">MALE</option>
                                            <option value="FEMALE">FEMALE</option>
                                        </b-select>
                                    </b-field>
                                </div>

                                <div class="column">
                                     <b-field label="Contact No." label-position="on-border">
                                        <b-input v-model="fields.contact_no" placholder="Contact No" />
                                    </b-field>
                                </div>
                            </div>


                        </form>

                    </div><!--container -->
                </section>
                <footer class="modal-card-foot">
                    <b-button
                        label="Close"
                        @click="isModalProfile=false"/>
                </footer>
            </div>

        </b-modal>
        <!--close modal-->




    </div><!-- root div -->


</div>
</template>

<script>

export default {

    data(){
        return{
            user: {},
            fields: {},
            errors: {},


            isQRModal: false,
            isModalProfile: false,

            btnClass: {
                'is-success': true,
                'button': true,
                'is-loading':false,
            },

        }
    },

    methods: {
        loadUser: function(){
            axios.get('/get-user').then(res=>{
                this.user = res.data;

            }).catch(err=>{

            })
        },

        openModalQR: function(){
            this.isQRModal = true;
        },

        openModalProfile(){
            this.fields = {};
            this.isModalProfile = true;

            this.fields = this.user;


        }
    },

    mounted() {
        this.loadUser();
    }
}
</script>

<style scoped>
    .qr-container{
       display: flex;
        justify-content: center;
        flex-direction: column;
        text-align: center;
    }
</style>


<style scoped>
    .cover {
        object-fit: scale-down;
    }
</style>
