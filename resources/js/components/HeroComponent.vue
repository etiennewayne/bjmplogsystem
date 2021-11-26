<template>
    <div>
        <section class="hero is-fullheight nim">
            <div class="hero-body">
                <div class="">
                <p class="title">
                    WELCOME TO BJMP E-LOG SYSTEM
                </p>
                <p class='subtitle'>
                    "Changing Lives, Building a Safer nation"
                </p>
                 <div class="columns">
                <div class="column is-4 is-offset-4">
                    <div class="time-container">
                        <b-field label="SELECT DATE">
                            <b-datetimepicker
                                placeholder="Type or select a date..."
                                icon="calendar-today"
                                :locale="locale"
                                editable>
                            </b-datetimepicker>
                        </b-field>
                    </div>
                </div>
            </div>
               
                </div>
            </div>
        </section>
        
        <img loading="lazy" width="250" height="249" src="https://secureservercdn.net/198.71.233.39/e0t.3dd.myftpupload.com/wp-content/uploads/2020/07/bjmp.png" alt="" class="wp-image-149" srcset="https://secureservercdn.net/198.71.233.39/e0t.3dd.myftpupload.com/wp-content/uploads/2020/07/bjmp.png 250w, https://secureservercdn.net/198.71.233.39/e0t.3dd.myftpupload.com/wp-content/uploads/2020/07/bjmp-150x150.png 150w" sizes="(max-width: 250px) 100vw, 250px">
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
<div style="background-color:#4FC2F2;padding-left: 15px">Best Regional Health Service Division</div></marquee>

    </div>
   
</template>
<script>

export default {
    data(){
        return{

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

    .title{
        color: black;
        font-style: bold;
    }

    .subtitle{
        color: black;
        font-style: oblique;
    }
</style>

