@extends('agent.layouts.app')
@section('title', 'Udistro | Profile')

@section('content')
  
  <!-- Canada Post API -->
  <script type="text/javascript" src="https://ws1.postescanada-canadapost.ca/js/addresscomplete-2.30.min.js?key=kp88-mx67-ff25-xd59"></script>
  <link rel="stylesheet" type="text/css" href="https://ws1.postescanada-canadapost.ca/css/addresscomplete-2.30.min.css?key=kp88-mx67-ff25-xd59" />

  <script type="text/javascript">
  var fields = [
    { element: "agent_address1", field: "Line1" },
    { element: "agent_address2", field: "Line2", mode: pca.fieldMode.POPULATE },
    { element: "city", field: "City", mode: pca.fieldMode.POPULATE },
    { element: "state", field: "ProvinceName", mode: pca.fieldMode.POPULATE },
    { element: "agent_postalcode", field: "PostalCode" },
    { element: "country", field: "CountryName", mode: pca.fieldMode.COUNTRY }
  ],
  options = {
    key: "kp88-mx67-ff25-xd59"
  },
  control = new pca.Address(fields, options);

  // On the selesction of address get the province abbreviation, and set it on the province dropdown
  control.listen("populate", function (address) {

      $("#agent_province option").each(function() {
      if($(this).data('abbreviation') == address.Province)
      {
        $(this).attr('selected', 'selected').change();
      }
    });

  });

  $(document).ready(function(){
    // To pot a space after user enters 3 characters like (123 456)
    $('#postal_code').keyup(function() {
        var postalCode = $(this).val().split(" ").join("");
        if (postalCode.length > 0) {
          postalCode = postalCode.match(new RegExp('.{1,3}', 'g')).join(" ");
        }
        $(this).val(postalCode);
    });
  });
  </script>
  <div class="container-fluid text-center">
    <div class="col-lg-6 center-box">
        <div class="col-lg-12">
          <h1 class="page-header">Profile</h1>
        </div>
        <div class="col-lg-12 profile-box">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#profile">Information</a></li>
            <li><a data-toggle="tab" href="#message">Brand</a></li>
            <!-- <li><a data-toggle="tab" href="#template">Template</a></li> -->
          </ul>
          <div class="tab-content">
            <div id="profile" class="tab-pane fade in active">
              <div class="row top-buffer"> 
                  <!-- left column -->
                  <div class="col-md-12">
                    <form class="form-horizontal accordian" role="form" name="frm_agent_profile" id="frm_agent_profile" novalidate>
                      <fieldset>
                        <legend>Personal: <span class="open-close"><i class="fa fa-angle-down" aria-hidden="true"></i></span></legend>
                    <div class="collapsbox" style="display:block;">
                          <div class="form-group">
                              <label class="col-lg-3 control-label">First name:</label>
                              <div class="col-lg-8">
                                <input class="form-control" value="{{ $agentDetails->fname or '' }}" name="agent_fname" id="agent_fname" type="text">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-lg-3 control-label">Last name:</label>
                              <div class="col-lg-8">
                                <input class="form-control" value="{{ $agentDetails->lname or '' }}" name="agent_lname" id="agent_lname" type="text">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-lg-3 control-label">Business name:</label>
                              <div class="col-lg-8">
                                <input class="form-control" value="{{ $agentDetails->business_name or '' }}" name="agent_bname" id="agent_bname" type="text">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-lg-3 control-label">Gender:</label>
                              <div class="col-lg-8">
                          <div class="gender-box">
                            <label class="control-label"> <input name="gender" value="1" checked="true" type="radio" <?php if($agentDetails->gender == 1) echo 'checked'; ?>> Male</label>
                          </div>
                          <div class="gender-box">
                            <label class="control-label"><input name="gender" value="2" type="radio" <?php if($agentDetails->gender == 2) echo 'checked'; ?>> Female</label>
                          </div>
                          <div class="gender-box">
                            <label class="control-label"><input name="gender" value="0" type="radio" <?php if($agentDetails->gender == 0) echo 'checked'; ?>> Others</label>
                          </div>
                              </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">&nbsp;</label>
                            <div class="col-lg-8">
                                <div class="ui-select">
                                  <button type="submit" class="btn btn-primary" name="btn_update_agent_profile" id="btn_update_agent_profile">Submit</button>
                                </div>
                            </div>
                          </div>
                    </div>
                      </fieldset>
                   </form>

                   <form class="form-horizontal accordian" role="form" name="frm_agent_contact" id="frm_agent_contact" novalidate>
                      <fieldset>
                        <legend>Contact: <span class="open-close"><i class="fa fa-angle-down" aria-hidden="true"></i></span></legend>
                    <div class="collapsbox" style="display:none;">
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Email:</label>
                              <div class="col-lg-8">
                                <input class="form-control" value="{{ $agentDetails->email or '' }}" name="agent_email" id="agent_email" type="text">
                              </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Phone Number:</label>
                              <div class="col-lg-8">
                                <input class="form-control" value="{{ $agentDetails->phone_number or '' }}" name="phone_number" id="phone_number" type="text" placeholder="Ex: (123) 456 7899, (123)-456-7899, 123-456-7899, 123 456 7899, 1234567899">
                              </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Extention Number:</label>
                              <div class="col-lg-8">
                                <input class="form-control" value="{{ $agentDetails->extension_number or '' }}" name="ex_number" id="ex_number" type="text">
                              </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Fax:</label>
                              <div class="col-lg-8">
                                <input class="form-control" value="{{ $agentDetails->fax or '' }}" name="fax" id="fax" type="text">
                              </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">Website:</label>
                              <div class="col-lg-8">
                                <input class="form-control" value="{{ $agentDetails->website or '' }}" name="agent_website" id="agent_website" type="text">
                              </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">&nbsp;</label>
                            <div class="col-lg-8">
                                <div class="ui-select">
                                  <button type="submit" class="btn btn-primary" name="btn_update_agent_contact" id="btn_update_agent_contact">Submit</button>
                                </div>
                            </div>
                          </div>
                    </div>
                  </fieldset>
                </form>

                <form class="form-horizontal" role="form" name="frm_agent_address" id="frm_agent_address" novalidate>
                      <fieldset>
                      <legend>Address: <span class="open-close"><i class="fa fa-angle-down" aria-hidden="true"></i></span></legend>
                    <div class="collapsbox" style="display: none;">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Address Line 1:</label>
                            <div class="col-lg-8">
                              <input name="agent_address1" id="agent_address1" class="form-control" value="{{ $agentDetails->address1 or '' }}" placeholder="Enter address" autocomplete="off" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Address Line 2:</label>
                            <div class="col-lg-8">
                              <input name="agent_address2" id="agent_address2" class="form-control" value="{{ $agentDetails->address2 or '' }}" placeholder="Enter address line 2" autocomplete="off" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">City:</label>
                            <div class="col-lg-8">
                              <div class="ui-select">
                                <select id="agent_city" class="form-control" name="agent_city">
                                  <option value="">Select</option>
                                  <?php
                                  if( isset( $cityArray ) && count( $cityArray ) > 0 )
                                  {
                                    foreach($cityArray as $city)
                                    {
                                      $selected = '';
                                      if($agentDetails->city_id  == $city['id']) 
                                      {
                                        $selected = 'selected';
                                      }
                                      echo '<option value="'. $city['id'] .'" '. $selected .'>'. $city['city'] .'</option>';
                                    }
                                  }
                                  ?>
                                </select>
                              </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Province:</label>
                            <div class="col-lg-8">
                              <div class="ui-select">
                                <select id="agent_province" class="form-control" name="agent_province">
                                  <option value="">Select</option>
                                  <?php
                                  if( isset( $provinces ) && count( $provinces ) > 0 )
                                  {
                                    foreach($provinces as $province)
                                    {
                                      $selected = '';
                                      if($agentDetails->province_id  == $province->id) 
                                      {
                                        $selected = 'selected';
                                      }
                                      echo '<option data-abbreviation="'. $province->abbreviation .'" value="'. $province->id .'" '. $selected .'>'. $province->name .'</option>';
                                    }
                                  }
                                  ?>
                                </select>
                              </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Postal Code:</label>
                            <div class="col-lg-8">
                              <input id="agent_postalcode" name="agent_postalcode" type="text" class="form-control" placeholder="Zip/Postcode" value="{{ $agentDetails->postalcode or '' }}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Country:</label>
                            <div class="col-lg-8">
                              <div class="ui-select">
                                <select name="agent_country" id="agent_country" class="form-control">
                                  <option value="">Select</option>
                                  <?php
                                  if( isset( $countries ) && count( $countries ) > 0 )
                                  {
                                    foreach($countries as $country)
                                    {
                                      $selected = '';
                                      if($agentDetails->country_id  == $country->id) 
                                      {
                                        $selected = 'selected';
                                      }
                                      echo '<option value="'. $country->id .'" '. $selected .'>'. $country->name .'</option>';
                                    }
                                  }
                                  ?>
                                </select>
                              </div>
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="col-lg-3 control-label">&nbsp;</label>
                          <div class="col-lg-8">
                              <div class="ui-select">
                                <button type="submit" class="btn btn-primary" name="btn_update_agent_address" id="btn_update_agent_address">Submit</button>
                              </div>
                          </div>
                        </div>
                      </fieldset>
                  </form>

                  <form class="form-horizontal" role="form" name="frm_agent_social" id="frm_agent_social">
                      <fieldset>
                        <legend>Social: <span class="open-close"><i class="fa fa-angle-down" aria-hidden="true"></i></span></legend>
                    <div class="collapsbox" style="display: none;">
                          <div class="form-group">
                              <label class="col-lg-3 control-label">Facebook:</label>
                              <div class="col-lg-8">
                                <input class="form-control" value="{{ $agentDetails->facebook or '' }}" name="agent_facebook" id="agent_facebook" type="text">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-lg-3 control-label">Twitter:</label>
                              <div class="col-lg-8">
                                <input class="form-control" value="{{ $agentDetails->twitter or '' }}" name="agent_twitter" id="agent_twitter" type="text">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-lg-3 control-label">LinkedIn:</label>
                              <div class="col-lg-8">
                                <input class="form-control" value="{{ $agentDetails->linkedin or '' }}" name="agent_linkedin" id="agent_linkedin" type="text">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-lg-3 control-label">Google Plus:</label>
                              <div class="col-lg-8">
                                <input class="form-control" value="{{ $agentDetails->gplus or '' }}" name="agent_gplus" id="agent_gplus" type="text">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-lg-3 control-label">Skype:</label>
                              <div class="col-lg-8">
                                <input class="form-control" value="{{ $agentDetails->skype or '' }}" name="agent_skype" id="agent_skype" type="text">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-lg-3 control-label">Instagram:</label>
                              <div class="col-lg-8">
                                <input class="form-control" value="{{ $agentDetails->instagram or '' }}" name="agent_instagram" id="agent_instagram" type="text">
                              </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-3 control-label">&nbsp;</label>
                            <div class="col-lg-8">
                                <div class="ui-select">
                                  <button type="submit" class="btn btn-primary" name="btn_update_agent_social" id="btn_update_agent_social">Submit</button>
                                </div>
                            </div>
                          </div>
                    </div>
                    </fieldset>
                </form>
              </div>
            </div>
          </div>

          <div id="message" class="tab-pane fade">
              <div class="profile-wrap">
                  <form class="form-horizontal" role="form" name="frm_agent_image" id="frm_agent_image">
                    <div class="profile-box text-center"> 
                      <div class="profile-pic-box">
                        <?php
                    if( $agentDetails->image != '' )
                    {
                      echo '<img src="'. url('/images/agents/' . $agentDetails->image) .'" id="agent_profile_image" height="" width="" class="avatar img-circle" alt="avatar">';
                    }
                    else
                    {
                      echo '<img src="'. url('/images/no_image.jpg') .'" id="agent_profile_image" height="" width="" class="avatar img-circle" alt="avatar">';
                    }
                    ?>
                    <div class="edit-profile-pic">
                      <label for="agent_upload_image"><i class="fa fa-pencil" aria-hidden="true"></i></label>
                        <input type="file" id="agent_upload_image" name="agent_upload_image" accept="image/*" style="display: none">
                    </div>
                  </div>
                      <div class="top-buffer"> 
                        <!-- To upload image -->
                    <div class="sub-can-box">
                      <button type="submit" class="btn btn-primary" name="btn_update_agent_image" id="btn_update_agent_image">Save</button>
                    </div>
                      </div>
                    </div>
                  </form>
              </div>
              <!-- <div class="message-box">
                  <h3>Message</h3>
                  <form class="form-horizontal" role="form" name="frm_agent_message" id="frm_agent_message" novalidate>
                    <div class="form-group">
                      <div class="col-lg-12">
                        <textarea class="form-control" rows="10" name="agent_message" id="agent_message">{{ $message->message or '' }}</textarea>
                      </div>
                    </div>
                    <div>
                      <div class="ui-select">
                        <button type="submit" class="btn btn-primary" name="btn_update_agent_message" id="btn_update_agent_message">Submit</button>
                      </div>
                    </div>
                  </form>
              </div> -->
            </div>

            <!-- <div id="template" class="tab-pane fade">
              <div class="email-template-wrap">
                <form class="form-horizontal" role="form" name="frm_agent_email_template" id="frm_agent_email_template" novalidate>
                    <div class="form-group">
                      <div class="col-lg-12"> 
                        <?php
                          if( isset( $templates ) && count( $templates ) > 0 )
                          {
                            foreach ($templates as $template)
                            {
                              $checked = '';
                              if ( isset($agentTemplate->id) && ($agentTemplate->id == $template->id) )
                              {
                                $checked = 'checked="true"';
                              }
                              echo "<div class='template-select'><label class='control-label'><input name='agent_email_template' value='".$template->id."' type='radio' ".$checked."> ".ucwords( strtolower( $template->template_name ) )."</label></div>";
                            }
                          }
                        ?>
                        <label id="agent_email_template-error" class="error" for="agent_email_template"></label>
                      </div>
                    </div>
                    <div>
                      <h4>Template Preview</h4>
                      <div id="email_template_preview" style="min-height: 500px; width:600px;">
                        <?php
                          if( isset( $agentTemplateContent ) && count( $agentTemplateContent ) > 0 )
                          {
                            echo $agentTemplateContent->template_content;
                          }
                        ?>
                      </div>
                    </div>
                    <div class="top-buffer">
                      <div class="ui-select">
                        <button type="submit" class="btn btn-primary" name="btn_update_agent_email_template" id="btn_update_agent_email_template">Submit</button>
                      </div>
                    </div>
                </form>
            </div>
          </div> -->

          <br />
        </div>
      </div>
    </div>
  </div>
  
<script type="text/javascript">
/*Toggle*/
 $(document).ready(function(){
    $('.tab-content .collapsbox').hide();
    $('.tab-content legend:first').addClass('active').next().slideDown('slow');
    $('.tab-content legend').click(function() {
        if($(this).next().is(':hidden')) {
            $('.tab-content legend').removeClass('active').next().slideUp('slow');
            $(this).toggleClass('active').next().slideDown('slow');
        }
    });
});
</script>
@endsection