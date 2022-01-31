<template>
<div>
    <template>
        <div>
            <b-navbar>
                <template #brand>
                    <b-navbar-item>
                        <strong>ADMINISTRATOR</strong>
                    </b-navbar-item>
                </template>
                <template #start>
                    <b-navbar-item href="#">
                        Home
                    </b-navbar-item>
                    <b-navbar-item href="/users">
                        Appointments
                    </b-navbar-item>
                    <b-navbar-item href="/users">
                        Users
                    </b-navbar-item>

                    <b-navbar-dropdown :label="firstname">
                        <b-navbar-item href="#">
                            Profile
                        </b-navbar-item>
                        <b-navbar-item @click="logout">
                            Logout
                        </b-navbar-item>
                    </b-navbar-dropdown>

                </template>
            </b-navbar>


        </div>

    </template>
</div>
</template>

<script>
export default {

    props: ['firstname'],
    methods: {
        logout(){
            axios.post('/logout').then(()=>{
                window.location = '/';
            })
        }
    }
}
</script>

<style scoped>

</style>
