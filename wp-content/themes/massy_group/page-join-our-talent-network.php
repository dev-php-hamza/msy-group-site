
<?php get_header(); ?>

<main>
  <!-- Banner section -->
  <div class="BusinessBanner careerBanner">
    <div class="container h-100">
      <div
        class="d-flex justify-content-end align-items-center h-100 overflow-hidden"
      >
        <h2 data-aos="fade-left">careers in Massy</h2>
      </div>
      <a href="<?=get_permalink( get_page_by_path( 'careers' ))?>" class="backBtn">
        <img src="<?php echo get_template_directory_uri()?>/assets/images/backBtn.png" />BACK TO CAREERS</a
      >
    </div>
  </div>

  <div class="career_form mt-93">
    <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post" id="talent-form" enctype="multipart/form-data">
      <div class="careerFormBox">
        <h4>Talent Network Registration</h4>
        <input type="hidden" name="action" value="career_registration">
        <div class="d-flex align-items-center flex-wrap nameInput">
          <div>
            <input type="text" name="talent_network_applicants[first_name]" placeholder="First Name" required  />
          </div>
          <div>
            <input type="text" name="talent_network_applicants[last_name]" placeholder="Last Name" required />
          </div>
        </div>
        <div class="d-flex align-items-center flex-wrap nameInput col_wrap">
          <div>
            <input type="email" name="talent_network_applicants[email]" placeholder="Email" required />
          </div>
          <div class="d-flex align-items-center area__code">
            <input type="number" name="talent_network_applicants[area_code]" placeholder="Area Code" class="areaCode" required />
            <input type="number" name="talent_network_applicants[phone]" placeholder="Phone Number" required/>
          </div>
        </div>
        <div class="nameInput">
          <input type="text" name="talent_network_applicants[address_line_1]" placeholder="Address Line 1" required />
        </div>
        <div class="d-flex align-items-center flex-wrap nameInput">
          <div>
            <input type="text" name="talent_network_applicants[city]" placeholder="City" required />
          </div>
          <div>
            <input type="text" name="talent_network_applicants[state]" placeholder="State"/>
          </div>
        </div>
        <div class="d-flex align-items-center flex-wrap nameInput">
          <div>
            <input type="text" name="talent_network_applicants[zip_code]" placeholder="Zip Code"/>
          </div>
          <div>
            <!-- <input type="text" name="talent_network_applicants[country]" placeholder="Country" /> -->
            <select name="talent_network_applicants[country]" required>
              <option value="">Country</option>
              <?php foreach ($wp_country->countries_list() as $code => $country) {?>
                <option value="<?=$country?>" ><?=$country?></option>
              <?php }?>
            </select>
          </div>
        </div>
        <div
          class="d-flex align-items-center flex-wrap nameInput selectInput"
        >
          <select name="talent_network_applicants[citizen]" required>
            <option selected disabled>Residency Status</option>
            <option value="Citizen">Citizen</option>
            <option value="Permanent Resident">Permanent Resident</option>
            <option value="Work Permit">Work Permit</option>
          </select>
          <img src="<?php echo get_template_directory_uri()?>/assets/images/caretDown.png" class="caretImage" />
        </div>
        <div class="nameInput">
          <textarea name="talent_network_applicants[interest_in_massy]" placeholder="Explain your interest in Massy" required></textarea>
        </div>
        <div class="nameInput">
          <textarea name="talent_network_applicants[additional_info]" placeholder="Additional info" required></textarea>
        </div>
        <label for="resume" class="upload_resume">
          upload resume
        </label>
        <p class="error-msg"></p>
        <input type="file" name="resume" id="resume" class="d-none" />
        <div class="g-recaptcha" data-sitekey="6LeUfQcaAAAAAAES6R7TrqI7f8BKt35hHVgDZwq_"></div>
        <div id="recaptcha_error" style="display:none;color: red;background: white;margin: 10px 0;padding: 10px;border: 1px solid;border-radius: 10px;">Please complete the Re-captcha authentication to submit the form.</div>
        <?php //echo do_shortcode( '[bws_google_captcha]' ); ?>
      </div>

      <div class="container d-flex justify-content-center" style="margin-bottom: 56px;">
        <input type="submit" class="continue talentSubmit" />
      </div>
    </form>
  </div>

  <!-- news & update -->
  <?php get_sidebar('news-and-updates'); ?>
  <!-- who we are section -->
  <?php get_sidebar('who-we-are'); ?>

  <!-- How we performance section -->
  <?php get_sidebar('performance-section-main'); ?>
</main>

<?php get_footer(); ?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">


jQuery(document).ready(function(e){
  jQuery("form#talent-form").submit(function(e){
    e.preventDefault();
    jQuery("#recaptcha_error").hide();
    let flag = true;
      let file = $("#resume");
      let sitekey = grecaptcha.getResponse();

      if(file.val() == null || file.val() == ""){
        file.addClass("error");
        file.siblings("p").html("Please provide your resume.");
        file.siblings("p").show();
        flag = false;
      }
      else if(sitekey.length > 0 || sitekey == ""){   
        jQuery.ajax({
          url: '<?php echo esc_url( admin_url('admin-post.php') ); ?>',
          type: "POST",
          data:  new FormData(this),
          contentType: false,
          cache: false,
          processData:false,
          beforeSend : function(){console.log("beforeSend");},
          success: function(data){
            if(data == "reCAPTCHA_ERROR"){
              jQuery("#recaptcha_error").show();
              // alert("Please complete the Re-captcha authentication to submit the form.");
            }
            else{
              window.location.href = data;
            }
            //console.log(data)
          },
          error: function(e) 
          {
            console.log(e);
          }          
        });           
      }
      else{
        file.removeClass("error");
        file.siblings("p").hide();
      }
      if(!flag){
        return false;
      }
  });
});
</script>