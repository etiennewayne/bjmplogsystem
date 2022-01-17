<template>
    <div>
        <div class="hero is-fullheight nim">

            <div class="hero-head">
                <nav class="navbar">
                    <div class="container">
                        <div class="navbar-brand">
<!--                            <a class="navbar-item">-->
<!--                                <img src="https://bulma.io/images/bulma-type-white.png" alt="Logo">-->
<!--                            </a>-->

                            <span class="navbar-burger" data-target="navbarMenuHeroB">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </div>
                        <div id="navbarMenuHeroB" class="navbar-menu">
                            <div class="navbar-end">
<!--                                <a class="navbar-item is-active">-->
<!--                                    Home-->
<!--                                </a>-->
<!--                                <a class="navbar-item">-->
<!--                                    Examples-->
<!--                                </a>-->
<!--                                <a class="navbar-item">-->
<!--                                    Documentation-->
<!--                                </a>-->
                                <span class="navbar-item">
                                    <b-button type="is-primary" tag="a" href="/login" icon-left="login">
                                        LOGIN
                                    </b-button>
                                </span>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>


            <div class="hero-body">
                <div class="hero-form">
                    <p class="title">
                        WELCOME TO BJMP E-LOG SYSTEM
                    </p>
                    <p class='subtitle'>
                        "Changing Lives, Building a Safer nation"
                    </p>

                    <b-field expanded>
                        <b-datepicker
                            placeholder="Type or select a date..."
                            icon="calendar-today"
                            :locale="locale"
                            v-model="fields.appointment_date"
                            editable>
                        </b-datepicker >
                        <b-select expanded v-model="fields.meridian">
                            <option value="AM">MORNING</option>
                            <option value="PM">AFTERNOON</option>
                        </b-select>
                    </b-field>
                    <b-field>
                        <b-input type="text" v-model="fields.inmate" placeholder="Inmate Name" required></b-input>
                    </b-field>

                    <div class="buttons is-right">
                        <b-button type="is-success" @click="submit" icon="right-arrow">BOOK NOW</b-button>
                    </div>
                </div>
            </div>
        </div>



        <div class="section">

             <h1 class="title is-4" style="text-align: center;">
                <span class="mv-title">MISSION & VISION</span>
            </h1>

            <div class="columns">
                <div class="column is-8 is-offset-2">

                    <div class="columns">
                        <div class="column">
                            <div class="panel is-link">
                                <p class="panel-heading">
                                    MISSION
                                </p>

                                <div class="panel-body">
                                    “To enhance public safety by ensuring humane safekeeping and development of Persons

                                    Deprived of Liberty (PDL) in all District, City and Municipal Jails for their reintegration to Society.”
                                </div>
                            </div>

                        </div>
                        <div class="column">
                            <div class="panel is-link">
                                <p class="panel-heading">
                                    VISION
                                </p>

                                <div class="panel-body">
                                    “A premier institution highly regarded by Society for the secured and humane

                                    treatment of Persons Deprived of Liberty (PDL) by its competent and motivated Corps.”
                                </div>
                            </div>
                        </div>
                    </div> <!--columns-->
                </div><!--column-->
            </div>


        </div> <!-- section -->


        <section>
            <div class ="footer">

                <div class = "columns">

                    <div class="column">
                        <div class="footer-logo-wrapper">
                            <img class="footer-logo" src="/img/logobg.png">
                        </div>
                    </div>

                    <div class = "column">
                        <div class="p-5">
                            <div class="footer-component-title">
                                THE BJMP
                            </div>

                            <div>
                               As one of the five pillars of the Criminal Justice System,
                                the BJMP was created to address the growing
                                concern of jail management and penology problem.
                            </div>
                        </div>
                    </div>

                    <div class="column">
                        <div class="p-5">
                            <div class="footer-component-title">
                                OUR LOCATION
                            </div>

                            <div>
                                 BJMP Regional Office 8
                            </div>
                            <div>
                                 Brgy. Santa Cruz, Tangub, City
                            </div>
                            <div>
                                7214, Philippines
                            </div>

                        </div>


                    </div>

                </div>
            </div>

        </section>

        <section>
            <div class ="footertwo">

                <div class = "columns">

                    <div class="column">
                        <div class="footertwo-logo-wrapper">
                            <img class="footertwo-logo" src="/img/roplogo.png">
                        </div>
                         </div>

                    <div class = "column">
                        <div class="p-5">
                            <div class="footer-component-title">
                                REPUBLIC OF THE PHILIPPINES
                            </div>
                            <div>
                               All content is in the public domain unless otherwise stated.
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="p-5">
                            <div class="footer-component-title">
                                ABOUT GOVPH
                            </div>
                             <div>
                                Learn more about the Philippine government, its structure,
                                how government works and the people behind it.
                             </div>
                             <div>
                                GOV.PH
                             </div>
                             <div>
                                  Open Data Portal
                             </div>
                             <div>
                                 Official Gazette
                             </div>
                        </div>
                        </div>
                    <div class="column">
                        <div class="p-5">
                            <div class="footer-component-title">
                                GOVERNMENT LINKS
                            </div>
                             <div>
                                Office of the President
                             </div>
                               <div>
                                Office of the Vice President
                               </div>
                               <div>
                                   Senate of the Philippines
                               </div>
                               <div>
                                    House of Representatives
                               </div>
                              <div>
                                   Supreme Court
                              </div>
                            <div>
                                Court of Appeal
                            </div>
                        </div>
                         </div>
                </div>
            </div>
        </section>



        <!--modal create-->
        <b-modal v-model="isModal" has-modal-card
                 trap-focus
                 :width="640"
                 aria-role="dialog"
                 aria-label="Modal"
                 aria-modal>

            <form @submit.prevent="loginSubmit">
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">LOGIN</p>
                        <button
                            type="button"
                            class="delete"
                            @click="isModal = false"/>
                    </header>

                    <section class="modal-card-body">
                        <div class="">
                            <div class="columns">
                                <div class="column">
                                    <b-field label="Username" label-position="on-border"
                                             :type="this.errors.username ? 'is-danger':''"
                                             :message="this.errors.username ? this.errors.username[0] : ''">
                                        <b-input v-model="creds.username"
                                                 placeholder="Username" required>
                                        </b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Password" label-position="on-border"
                                             :type="this.errors.password ? 'is-danger':''"
                                             :message="this.errors.password ? this.errors.password[0] : ''">
                                        <b-input type="password" password-reveal v-model="creds.password"
                                                 placeholder="Password" required>
                                        </b-input>
                                    </b-field>
                                </div>
                            </div>
                        </div>
                    </section>
                    <footer class="modal-card-foot">
                        <div class="level">
                            <div class="level-left">
                                <div class="level-item">
                                    <button
                                        :class="btnClass"
                                        label="Save"
                                        type="is-success">LOGIN</button>
                                </div>
                            </div>
                            <div class="level-right">
                                <div class="level-item">
                                    <div class="buttons is-right">
                                        <b-button type="is-link" tag="a" href="/register">REGISTER HERE</b-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </form><!--close form-->
        </b-modal>
        <!--close modal-->





    </div>  <!-- root div -->

</template>
<script>

export default {
    data(){
        return{
            locale: undefined,
            fields: {},
            errors: {},

            creds: {},

            isModal: false,

            btnClass: {
                'is-success': true,
                'button': true,
                'is-loading':false,
            },

        }
    },
    methods: {
        submit: function(){
            axios.post('/appointments', this.fields).then(res=>{
                console.log(res.data.message);
            }).catch(err=>{
                if(err.response.status === 401){
                    this.isModal = true;
                }
            });
        },


        loginSubmit: function(){
            axios.post('/login', this.creds).then(res=>{

            });
        }
    }
}
</script>


<style scoped>
    .nim{
        background-image: url("/img/subbc.jpg");
        background-position: center;
        background-size: cover;
    }

    .hero-form{
        padding: 30px;
        margin: auto;
        background-color: rgb(70, 70, 70);
        border-radius: 10px;
    }


    .hero-form > .title, .subtitle{
        color: white;
    }
    .hero-form > .subtitle{
        color: white;
    }

    .title{
        color: black;
        font-style: bold;
    }

    .subtitle{
        color: black;
        font-style: oblique;
    }

    .section{
        margin-top: 50px;
    }

    .mv-title{
        padding-bottom: 10px;
        border-bottom: 2px solid rgb(74, 92, 255);
    }

    .panel-body{
        padding: 20px;
    }



    .panel-body{
        padding: 20px;
    }
    .footer{
        margin-top: 50px;
        background-color: #333333;
        color: #cecece;
    }

    .footer-logo{
        height: 200px;
        margin: auto;
    }
    .footer-logo-wrapper{
        display: flex;
        height: 130%;
        justify-content: center;
        align-items: center;
    }

    .footer-component-title{
        font-weight: bold;
        margin-bottom: 10px;
    }
    .footertwo-logo{
        height: 130px;
        margin: auto;
        opacity: 0.5;
    }
    .footertwo-logo-wrapper{
        display: flex;
        height: 100%;
        justify-content: center;
        align-items: center;
    }



</style>

