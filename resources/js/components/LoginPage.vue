<template>
    <div class="login-wrapper">
        <div class="login">
            <div class="panel">
                <div class="panel-heading">
                    LOGIN
                </div>

                <div class="panel-body">
                    <b-field label="Username" label-position="on-border">
                        <b-input type="text" v-model="fields.username" placeholder="Username" />
                    </b-field>

                    <b-field label="Password" label-position="on-border">
                        <b-input type="password" v-model="fields.password" password-reveal placeholder="Password" />
                    </b-field>

                    <div class="buttons">
                        <b-button type="is-primary" @click="submit">LOGIN</b-button>
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
            erros: {},

        }
    },

    methods: {
        submit: function(){
            if(this.username == '' && this.password == ''){
                alert('Please input username and password.');
            }

            axios.post('/login', this.fields).then(res=>{
                window.location = '/dashboard';
                console.log(res.data);
            }).catch(err=>{
                console.log(err);
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
        width: 500px;
    }

    .panel > .panel-body{
        padding: 20px;

    }




</style>
