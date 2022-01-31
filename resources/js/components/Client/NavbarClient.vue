<template>

    <b-navbar>
        <template #brand>
            <b-navbar-item>
                <h1 class="title is-5">DASHBOARD</h1>
               
            </b-navbar-item>
        </template>
        <template #start>
            <b-navbar-item href="/my-dashboard">
                Home
            </b-navbar-item>
            <b-navbar-item href="my-appointment">
                My Appointment
            </b-navbar-item>
            <b-navbar-dropdown label="My Account">
                <b-navbar-item href="/my-change-password">
                    Change Password
                </b-navbar-item>
                <b-navbar-item href="/my-information">
                    My Infomation
                </b-navbar-item>

                <b-navbar-item @click="logout">
                    LOGOUT
                </b-navbar-item>
            </b-navbar-dropdown>
        </template>

        <template #end>

        </template>
    </b-navbar>

</template>


<script>
export default {
    name: "NavbarClient",
    methods:{
        logout(){
            axios.post('/logout').then(()=>{
                window.location = '/';
            });
        }
    }
}
</script>

<style scoped>

</style>
