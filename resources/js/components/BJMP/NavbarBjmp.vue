<template>

    <div>
        <b-navbar class="nav-shadow">
            <template #brand>
                <b-navbar-item>
                    <h1 class="title is-5">BJMP DASHBOARD</h1>

                </b-navbar-item>
            </template>
            <template #start>
                <b-navbar-item href="/bjmp-dashboard">
                    Home
                </b-navbar-item>
                <b-navbar-item href="/qr-scanner">
                    QR Scanner
                </b-navbar-item>

                 <b-navbar-dropdown label="Report">
                    <b-navbar-item href="/log-report">
                        Log Report
                    </b-navbar-item>
                </b-navbar-dropdown>

                <b-navbar-dropdown label="My Account">
                    <b-navbar-item @click="modalChangePassword = true">
                        Change Password
                    </b-navbar-item>
                    <b-navbar-item @click="logout">
                        LOGOUT
                    </b-navbar-item>
                </b-navbar-dropdown>
            </template>

            <template #end>

            </template>
        </b-navbar>


        <!--modal create-->
        <b-modal v-model="modalChangePassword" has-modal-card
                 trap-focus
                 :width="640"
                 aria-role="dialog"
                 aria-label="Modal"
                 aria-modal>

            <form @submit.prevent="submit">
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Change Password</p>
                        <button
                            type="button"
                            class="delete"
                            @click="modalChangePassword = false"/>
                    </header>

                    <section class="modal-card-body">
                        <div class="">
                            <b-field label="Old Password"
                                     :type="this.errors.old_password ? 'is-danger':''"
                                     :message="this.errors.old_password ? this.errors.old_password[0] : ''">
                                <b-input v-model="fields.old_password" type="password" password-reveal icon="password" required></b-input>
                            </b-field>

                            <b-field label="New Password"
                                     :type="this.errors.password ? 'is-danger':''"
                                     :message="this.errors.password ? this.errors.password[0] : ''">
                                <b-input v-model="fields.password" type="password" password-reveal icon="password" required></b-input>
                            </b-field>

                            <b-field label="Confirm Password"
                                     :type="this.errors.password_confirmation ? 'is-danger':''"
                                     :message="this.errors.password_confirmation ? this.errors.password_confirmation[0] : ''">
                                <b-input v-model="fields.password_confirmation" type="password" password-reveal icon="account" required></b-input>
                            </b-field>

                        </div>
                    </section>
                    <footer class="modal-card-foot">
                        <b-button
                            label="Close"
                            @click="modalChangePassword=false"/>
                        <button
                            :class="btnClass"
                            label="Save"
                            type="is-success">SAVE</button>
                    </footer>
                </div>
            </form><!--close form-->
        </b-modal>
        <!--close modal-->



    </div>


</template>


<script>
export default {

    data(){
        return{
            modalChangePassword: false,
            errors: {},
            fields: {},

            btnClass: {
                'is-success': true,
                'button': true,
                'is-loading':false,
            },
        }
    },
    methods:{
        logout(){
            axios.post('/logout').then(()=>{
                window.location = '/';
            });
        },

        submit: function(){
            axios.post('/bjmp-change-password', this.fields).then(res=>{
                if(res.data.status == 'updated'){
                    this.$buefy.toast.open({
                        message: 'Password changed successfully.',
                        type: 'is-success'
                    });
                    this.modalChangePassword = false;
                    this.fields = {};
                    this.errors = {};
                }
            }).catch(err=> {
                if (err.response.status === 422) {
                    this.errors = err.response.data.errors;
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
