<template>
    <div>
        <section class="hero is-fullheight nim">
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
                            editable>
                        </b-datepicker >
                        <b-select expanded>
                            <option>MORNING</option>
                            <option>AFTERNOON</option>
                        </b-select>
                    </b-field>

                    <div class="buttons is-right">
                        <b-button type="is-success" icon="right-arrow">BOOK NOW</b-button>
                    </div>
                </div>
            </div>
        </section>


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
                                Brgy. Guindapunan, Palo, Leyte
                                6501, Philippines
                            </div>
                        </div>


                    </div>

                </div>
            </div>

        </section>



    </div>  <!-- root div -->

</template>
<script>

export default {
    data(){
        return{
            locale: undefined
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
        height: 100px;
        margin: auto;
    }
    .footer-logo-wrapper{
        display: flex;
        height: 100%;
        justify-content: center;
        align-items: center;
    }

    .footer-component-title{
        font-weight: bold;
        margin-bottom: 10px;
    }


</style>

