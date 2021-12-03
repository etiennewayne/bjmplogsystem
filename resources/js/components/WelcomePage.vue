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

                     <b-datetimepicker
                        placeholder="Type or select a date..."
                        icon="calendar-today"
                        :locale="locale"
                        editable>
                    </b-datetimepicker>
                
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

            
        </div>
<!-- 
        
        <img width="250" height="249" src="/img/bjmp.png" alt="">
        <h2 style="padding-left:20px;padding-right:10px">MISSION</h2>
       
        <p style="padding-left:20px;padding-right:10px">
“To enhance public safety by ensuring humane safekeeping and development of Persons 
</p>
<p style="padding-left:20px;padding-right:10px">
  Deprived of Liberty (PDL) in all District, City and Municipal Jails for their reintegration to Society.”
</p>
<h2 style="padding-left:20px;padding-right:10px">VISION</h2>
<p style="padding-left:20px;padding-right:10px">
“A premier institution highly regarded by Society for the secured and humane 
</p>
<p style="padding-left:20px;padding-right:10px">
treatment of Persons Deprived of Liberty (PDL) by its competent and motivated Corps.”
</p>

<h2><b>NEWS</b></h2>
<marquee behavior="scroll" scrollamount="2" direction="up"><a href="http://bjmp9.info/" title="BJMP Region IX Updates" style="color:black"><div style="padding-left: 10px;background-color: #FBD603"><b>JAIL VISITATION</b></div></a> 
<div style="background-color:#FFF176;padding-left: 15px;padding-bottom: 5px;padding-top: 5px">Jail visitations all throughout this region are still prohibited due to the pandemic.</div>
<br>
<a href="https://secureservercdn.net/198.71.233.39/e0t.3dd.myftpupload.com/wp-content/uploads/2021/07/Partnership-Meeting-on-the-Safety-Seal-Implementation.pdf" title="BJMP Region IX Recruitment" style="color:black"><div style="padding-left: 10px;background-color: #F4511E"><b>RECRUITMENT</b></div></a> 
<div style="background-color:#FF8A65;padding-left: 15px;padding-bottom: 5px;padding-top :5px">We are now accepting applications for the 2022 Jail Officer 1 Quota.</div>
<br>
<a href="http://bjmp9.info/" title="BJMP Region IX Awards" style="color:black"><div style="padding-left: 10px;background-color: #00897B"><b>AWARDS FOR THE 3RD QUARTER CY 2021</b></div></a>
<div style="background-color:#4DB6AC;padding-left: 15px">Top 5 Performing Regional Director</div>
<div style="background-color:#4DD0E1;padding-left: 15px">First Region to be granted with Safety Seal Certification</div>
<div style="background-color:#4FC2F2;padding-left: 15px">Best Regional Health Service Division</div></marquee>-->
<style>
    <div class="wp-block-columns">
<div class="wp-block-column">
<div class="wp-block-image"><figure class="aligncenter size-full"><img loading="lazy" width="180" height="180" src="https://bjmp8.com/gwt/wp-content/uploads/2021/10/bjmp-logo-180.png" alt="" class="wp-image-112" srcset="https://bjmp8.com/wp-content/uploads/2021/10/bjmp-logo-180.png 180w, https://bjmp8.com/wp-content/uploads/2021/10/bjmp-logo-180-150x150.png 150w" sizes="(max-width: 180px) 100vw, 180px"></figure></div>
</div>



<div class="wp-block-column">

<h3><span style="color: #ffffff;">The BJMP</span></h3>
<p><span style="color: #ffffff;">As one of the five pillars of the Criminal Justice System, the BJMP was created to address the growing concern of jail management and penology problem.</span></p>
</div>



<div class="wp-block-column">

<h3><span style="color: #ffffff;">Our Location</span></h3>
<p><span style="color: #ffffff;">BJMP Regional Office 8</span><br><span style="color: #ffffff;">Brgy. Guindapunan, Palo, Leyte</span><br><span style="color: #ffffff;">6501, Philippines</span></p>
</div>
</div>
</style>
    </div> 


   
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
 


</style>

