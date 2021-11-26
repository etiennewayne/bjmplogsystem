<template>
    <b-navbar fixed-top>
        <template #brand>+
            <img class="logo"
                src="/img/logobg.png">
           
        </template>
       
        <template #start>
            
            <b-navbar-item href="#">
                Homes
            </b-navbar-item>
            
            <b-navbar-item href="#">
                Documentation
            </b-navbar-item>
            <b-navbar-dropdown label="Info">
                <b-navbar-item href="#">
                    About
                </b-navbar-item>
                <b-navbar-item href="#">
                    Contact
                </b-navbar-item>
            </b-navbar-dropdown>
        </template>

        <template #end>
            <b-navbar-item tag="div">
                <div class="buttons">
                    <a class="button is-primary" href="/register-page">
                        <strong>Sign up</strong>
                    </a>
                    <a class="button is-light">
                        Log in
                    </a>
                </div>
            </b-navbar-item>
        </template>
    </b-navbar>
</template>



<style scoped>
    .logo{
        padding: 0 30px 0 30px;
        height: 90px;
    }

    .navbar{
        height: 100px;
        background-color: lightblue;
    }
</style>