<template>

    <section class="p-4">

        <div class="columns">
            <div class="column is-8 is-offset-2">
                <div class="panel">
                    <div class="panel-heading">
                        <b-button icon-left="chevron-left" tag="a" href="/" type="is-primary" inverted outlined></b-button>
                        <div class="mt-2">
                            REGISTER HERE
                        </div>
                    </div>
                    <form @submit.prevent="submit">
                        <div class="panel-body">
                            <div class="columns">
                                <div class="column">
                                    <b-field label="Username"
                                        :type="this.errors.username ? 'is-danger':''"
                                        :message="this.errors.username ? this.errors.username[0] : ''">
                                        <b-input type="text" v-model="fields.username" icon="account"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Password"
                                        :type="this.errors.password ? 'is-danger':''"
                                        :message="this.errors.password ? this.errors.password[0] : ''">
                                        <b-input type="password"  v-model="fields.password" icon="lock" password-reveal></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Re-type Password">
                                        <b-input type="password" icon="lock" v-model="fields.password_confirmation" password-reveal></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Email"
                                        :type="this.errors.email ? 'is-danger':''"
                                        :message="this.errors.email ? this.errors.email[0] : ''">
                                        <b-input type="email" v-model="fields.email" icon="email"></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Upload Image (Image size limit 800kb only)"
                                             :type="this.errors.img_path ? 'is-danger':''"
                                             :message="this.errors.img_path ? this.errors.img_path[0] : ''">
                                        <b-field class="file is-primary" :class="{'has-name': !!fields.img_path}">
                                            <b-upload v-model="fields.img_path" class="file-label">
                                        <span class="file-cta">
                                            <b-icon class="file-icon" icon="upload"></b-icon>
                                            <span class="file-label">Click to upload</span>
                                        </span>
                                                <span class="file-name" v-if="fields.img_path">
                                            {{ fields.img_path.name }}
                                        </span>
                                            </b-upload>
                                        </b-field>
                                    </b-field>

                                </div>

                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Last Name"
                                        :type="this.errors.lname ? 'is-danger':''"
                                        :message="this.errors.lname ? this.errors.lname[0] : ''" >
                                        <b-input @blur="capitalLname" icon="account" placeholder="Last Name" v-model="fields.lname" type="text"></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="First Name"
                                        :type="this.errors.fname ? 'is-danger':''"
                                        :message="this.errors.fname ? this.errors.fname[0] : ''">
                                        <b-input icon="account" @blur="capitalFname" v-model="fields.fname" placeholder="First Name" type="text"></b-input>
                                    </b-field>
                                </div>
                            </div>


                            <div class="columns">
                                <div class="column">
                                    <b-field label="Middle Name">
                                        <b-input type="text"></b-input>
                                    </b-field>
                                </div>

                                <div class="column">
                                    <b-field label="Suffix">
                                        <b-input type="text" placeholder="Suffix"></b-input>
                                    </b-field>
                                </div>

                                <div class="column is-3">
                                    <b-field label="Sex" expanded>
                                        <b-select placeholder="Sex" v-model="fields.sex" icon="account" expanded>
                                            <option value="MALE">MALE</option>
                                            <option value="FEMALE">FEMALE</option>
                                        </b-select>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Province" expanded
                                        :type="this.errors.province ? 'is-danger':''"
                                        :message="this.errors.province ? this.errors.province[0] : ''">
                                        <b-select v-model="fields.province" expanded placeholder="Province" @input="loadCity">
                                            <option v-for="(item, index) in provinces" :key="index" :value="item.provCode">{{ item.provDesc }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="City/Municipality" expanded
                                        :type="this.errors.city ? 'is-danger':''"
                                        :message="this.errors.city ? this.errors.city[0] : ''">
                                        <b-select expanded v-model="fields.city" placeholder="City" @input="loadBarangay">
                                            <option v-for="(item, index) in cities" :key="index" :value="item.citymunCode">{{ item.citymunDesc }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Barangay" expanded
                                        :type="this.errors.barangay ? 'is-danger':''"
                                        :message="this.errors.barangay ? this.errors.barangay[0] : ''">
                                        <b-select v-model="fields.barangay" expanded placeholder="Barangay">
                                            <option v-for="(item, index) in barangays" :key="index" :value="item.brgyCode">{{ item.brgyDesc }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="House #. Street">
                                        <b-input type="text"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="buttons is-right">
                                <button class="button is-link">Register</button>
                            </div>

                        </div><!--panel body-->
                    </form>


                </div> <!--panel -->
            </div>
        </div>


    </section>
</template>

<script>

export default {
    data() {

        return{

            fields: {
                username: '',
                password: '',
                password_confirmation: '',
                img_path: null,
                email: '',
                lname: '', fname: '', mname: '', suffix: '',
                sex: '', province: '', city: '', barangay: '', street: '',
            },
            errors: {},

            provinces: [],
            cities: [],
            barangays: [],
        }
    },

    methods: {


        //ADDRESS
        loadProvince: function(){
            axios.get('/load-provinces').then(res=>{
                this.provinces = res.data;
            })
        },
        loadCity: function(){
            axios.get('/load-cities?prov=' + this.fields.province).then(res=>{
                this.cities = res.data;
            })
        },

        loadBarangay: function(){
            axios.get('/load-barangays?prov=' + this.fields.province + '&city_code='+this.fields.city).then(res=>{
                this.barangays = res.data;
            })
        },


        submit: function(){

            var formData = new FormData();
            formData.append('username', this.fields.username);
            formData.append('password', this.fields.password);
            formData.append('password_confirmation', this.fields.password_confirmation);
            formData.append('img_path', this.fields.img_path);
            formData.append('email',  this.fields.email);
            formData.append('lname',  this.fields.lname);
            formData.append('fname',  this.fields.fname);
            formData.append('mname',  this.fields.mname);
            formData.append('suffix', this.fields.suffix);
            formData.append('sex', this.fields.sex);
            formData.append('province',  this.fields.province);
            formData.append('city',  this.fields.city);
            formData.append('barangay',  this.fields.barangay);
            formData.append('street',  this.fields.street);


            axios.post('/register-page', formData).then(res=>{

                if(res.data.status === 'saved'){
                    this.$buefy.dialog.alert({
                        title: "SAVED!",
                        message: 'You account is successfully saved.',
                        type: 'is-success',
                        onConfirm: ()=>  window.location = '/'
                    });
                }

            }).catch(err=>{
                if(err.response.status === 422){
                    this.errors = err.response.data.errors;
                }
            });
        },

        capitalLname() {
            this.fields.lname = this.fields.lname.charAt(0).toUpperCase() + this.fields.lname.slice(1);
        },
        capitalFname() {
            this.fields.fname = this.fields.fname.charAt(0).toUpperCase() + this.fields.fname.slice(1);
        },
        capitalMname() {
            this.fields.mname = this.fields.mname.charAt(0).toUpperCase() + this.fields.mname.slice(1);
        },
        capitalSuffix() {
            this.fields.suffix = this.fields.suffix.charAt(0).toUpperCase() + this.fields.suffix.slice(1);
        },


    },



    mounted(){
        this.loadProvince();
    }

}


</script>

<style scoped>
    .panel-body{
        padding: 20px;
    }

</style>

