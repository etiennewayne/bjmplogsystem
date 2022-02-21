<template>
    <div>

        <div class="hero is-fullheight nim">

            <div class="hero-head">
                <b-navbar>
                    <template #brand>
                    </template>
                    <template #start>


                    </template>
                    <template #end>
                        <b-navbar-item tag="div">
                            <b-dropdown aria-role="list" v-if="user != null">
                                <template #trigger="{ active }">
                                    <b-button
                                        :label="user.username.toUpperCase()"
                                        type="is-primary"
                                        :icon-right="active ? 'menu-up' : 'menu-down'" />
                                </template>


                                <b-dropdown-item tag="a" href="/my-dashboard" aria-role="listitem">My Dashboard</b-dropdown-item>
                                <b-dropdown-item @click="logout" aria-role="listitem">LOGOUT</b-dropdown-item>
                            </b-dropdown>
                            <b-button v-else type="is-primary" tag="a" href="/login" icon-left="login">
                                LOGIN
                            </b-button>
                        </b-navbar-item>
                    </template>

                </b-navbar>
            </div>


            <div class="hero-body">
                <div class="hero-form">
                    <p class="title">
                        WELCOME TO BJMP E-LOG SYSTEM
                    </p>
                    <p class='subtitle'>
                        "Changing Lives, Building a Safer nation"
                    </p>

                    <div class="columns">
                        <div class="column">
                            <b-field :type="errors.appointment_date ? 'is-danger' : ''"
                                     :message="errors.appointment_date ? errors.appointment_date[0] : ''">
                                <b-datepicker
                                    placeholder="Type or select a date..."
                                    icon="calendar-today"
                                    :locale="locale"
                                    @input="formatMeridian"
                                    v-model="fields.appointment_date"
                                    editable>
                                </b-datepicker >
                            </b-field>
                        </div>
                        <div class="column">
                            <b-field expanded
                                     :type="errors.meridian ? 'is-danger' : ''"
                                     :message="errors.meridian ? errors.meridian[0] : ''">
                                <b-select expanded v-model="fields.meridian" :disabled="allowMeridian">
                                    <option :disabled="amDisable" value="AM">MORNING</option>
                                    <option :disabled="pmDisable" value="PM">AFTERNOON</option>

                                </b-select>
                            </b-field>
                        </div>
                    </div>


                    <div class="columns">
                        <div class="column">
                            <b-field
                                :type="errors.inmate ? 'is-danger' : ''"
                                :message="errors.inmate ? errors.inmate[0] : ''">
                                <b-input type="text" v-model="fields.inmate" placeholder="Inmate Name" required></b-input>
                            </b-field>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="column">
                            <b-field expanded
                                     :type="errors.inmate_relationship ? 'is-danger' : ''"
                                     :message="errors.inmate_relationship ? errors.inmate_relationship[0] : ''">
                                <b-select expanded v-model="fields.inmate_relationship" placeholder="Inmate Relationship" required>
                                    <option v-for="(item, index) in inmate_relationships" :key="index" :value="item.inmate_relationship">{{ item.inmate_relationship }}</option>
                                </b-select>
                            </b-field>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="column">
                            <b-field>
                                <b-input type="text" placeholder="PURPOSE" v-model="fields.purpose"/>
                            </b-field>
                        </div>
                    </div>

                    <hr>
                    <h3 style="color: white; margin-bottom: 1em;">COMPANION</h3>

                    <div class="item-row" v-for="(item, k) in this.fields.companions" :key="k">
                        <div class="wrapper-item">
                            <b-field>
                                <b-input type="text" v-model="item.fullname" placeholder="Fullname"></b-input>
                            </b-field>

                            <b-field expanded>
                                <b-select expanded v-model="item.inmate_relationship" placeholder="Inmate Relationship" required>
                                    <option v-for="(i, index) in inmate_relationships" :key="index" :value="i.inmate_relationship">{{ i.inmate_relationship }}</option>
                                </b-select>
                            </b-field>
                        </div>

                        <div class="buttons mt-4 mb-4 is-right">
<!--                            <b-button @click="remove(k)" v-show="k || ( !k && fields.companions.length > 0)" type="is-danger" class="is-small" icon-left="delete"></b-button>-->
                            <b-button @click="remove(k)" v-show="k || ( !k && fields.companions.length > 0)" type="is-danger" class="is-small" icon-left="delete"></b-button>
                        </div>

                    </div>
                    <b-button @click="add" type="is-success" class="is-small" v-if="fields.companions.length < 4" icon-left="plus">ADD</b-button>


                    <div class="buttons is-right">
                        <b-button type="is-success" @click="submit" icon-left="calendar-plus">GET APPOINTMENT</b-button>
                    </div>
                </div>
            </div>
        </div>



        <div class="section">

             <h1 class="title is-4 mb-6" style="text-align: center;">
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


        <Div class="section">
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

        </Div>

        <div class="section">
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
        </div>



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
                                             :type="this.credErrors.username ? 'is-danger':''"
                                             :message="this.credErrors.username ? this.credErrors.username[0] : ''">
                                        <b-input v-model="creds.username"
                                                 placeholder="Username" required>
                                        </b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Password" label-position="on-border"
                                             :type="this.credErrors.password ? 'is-danger':''"
                                             :message="this.credErrors.password ? this.credErrors.password[0] : ''">
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
                                        <b-button type="is-link" tag="a" href="/register-page">REGISTER HERE</b-button>
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
    props: {
        propUser: {
            type: String,
            default: ''
        }
    },
    data(){
        return{
            locale: undefined,
            fields: {
                appointment_date: null,
                meridian: '',
                inmate: '',
                inmate_relationship: '',
                purpose: '',
                companions: []
            },
            //companions: [],
            errors: {},

            user: null,

            creds: {},
            credErrors: {},

            isModal: false,

            btnClass: {
                'is-success': true,
                'button': true,
                'is-loading':false,
            },

            inmate_relationships: [],

            amDisable: false,
            pmDisable: false,

        }
    },
    methods: {

        loadInmateRelationship: function(){
            axios.get('/get-inmate-relationships')
            .then(res=>{
                this.inmate_relationships = res.data;
            });
        },

        logout(){
            axios.post('/logout')
            .then(()=>{
                window.location = '/';
            })
        },

        submit: function(){

            axios.post('/appointments', this.fields).then(res=>{
                console.log(res.data.message);
                if(res.data.status === 'saved'){
                    this.$buefy.dialog.alert({
                        title: 'BOOKED!',
                        message: 'Your book information successfully saved.',
                        type: 'is-success',
                    })

                    this.clearFields();
                }
            }).catch(err=>{
                if(err.response.status === 422){
                    this.errors = err.response.data.errors;
                }
                if(err.response.status === 401){
                    this.isModal = true;
                }
            });
        },

        clearFields(){
            this.fields = {
                appointment_date: null,
                    meridian: '',
                    inmate: '',
                    inmate_relationship: '',
                    purpose: '',
                    companions: []
            }
        },


        loginSubmit: function(){
            axios.post('/login', this.creds).then(res=>{
                console.log('login');
                //window.location = '/';
                this.isModal = false;
                this.loadUser();
            }).catch(err=>{
                if(err.response.status === 422){
                    this.credErrors = err;
                }
            });
        },

        add () {
            this.fields.companions.push({
                appointment_id: 0,
                fullname: '',
                inmate_relationship: ''
            })
        },
        remove(index){
            //alert(index);
            this.fields.companions.splice(index, 1);
        },



        loadUser(){
            axios.get('/user').then(res=>{
                this.user = res.data;
            })
        },

        initData(){
            if(this.propUser != ''){
                this.user = JSON.parse(this.propUser);
            }
        },

        formatMeridian(){
            this.fields.meridian = '';
            let mydate = new Date(this.fields.appointment_date);

            let todayDate = new Date();

            var hours = todayDate.getHours();

            if(mydate.getFullYear() >= todayDate.getFullYear() && mydate.getMonth() >= todayDate.getMonth() && mydate.getDate() >= todayDate.getDate()){
                //true
                this.amDisable = false;
                this.pmDisable = false;

                if(hours >= 12) {
                    this.amDisable = true;
                }
            }else{
                //false
                this.amDisable = true;
                this.pmDisable = true;
            }
        }


    },

    mounted() {
        this.loadInmateRelationship();
        this.initData();
    },

    computed: {
        allowMeridian(){
            if(this.fields.appointment_date){
                return false;
            }else{
                return true;
            }
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



    .item-row{
        padding: 15px;
    }



</style>

