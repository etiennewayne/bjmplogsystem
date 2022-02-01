<template>
    <div class="login-wrapper">
        <div class="login">
            <div class="panel">
                <div class="panel-heading">
                    LOGIN
                </div>

                <div class="panel-body">
                    <b-field label="Username" label-position="on-border"
                             :type="this.errors.username ? 'is-danger':''"
                             :message="this.errors.username ? this.errors.username : ''">
                        <b-input type="text" v-model="fields.username" placeholder="Username" />
                    </b-field>

                    <b-field label="Password" label-position="on-border">
                        <b-input type="password" v-model="fields.password" password-reveal placeholder="Password" />
                    </b-field>

                    <div class="buttons">
                        <b-button type="is-primary" @click="submit">LOGIN</b-button>
                        <b-button tag="a" href="/register-page">REGISTER</b-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data(){
        return {
            fields: {
                //email: '',
                username: '',
                password: '',
            },
            errors: {},

        }
    },

    methods: {
        submit: function(){
            if(this.username == '' && this.password == ''){
                alert('Please input username and password.');
            }

            axios.post('/login', this.fields).then(res=>{
                //window.location = '/dashboard';
                let role = res.data.role;

                if(role === 'ADMINISTRATOR'){
                    window.location = '/dashboard';
                }
                else if(role === 'BJMP'){
                    window.location = '/bjmp-dashboard'
                }
                else if(role === 'USER'){
                    window.location = '/my-dashboard'
                }
            }).catch(err=>{
               if(err.response.status === 422){
                    this.errors = err.response.data.errors;
               }
            });
        }
    }
}
</script>


<style scope>
    .login-wrapper{
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login{

    }

    .panel > .panel-body{
        padding: 20px;

    }




</style>
