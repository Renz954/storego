<style>
.valid {
  border: 2px solid green;
}

.invalid {
  border: 2px solid red;
}
</style>
                     
      <div class="row column1">
         <div class="col-md-2"></div>
            <div class="col-md-12">
               <div class="full graph_head">
                  <div class="heading1 margin_0">
                     <h2>User profile</h2>
                  </div>
               </div>
               <div class="full price_table padding_infor_info">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="full dis_flex center_text">
                           <?php
                                 $currentPhoto = $this->Bookkeeper_Model->get_profile_name($_SESSION['id']);
                                 $currentPhoto = $currentPhoto['profile'];
                                 echo'<div class="profile_img"><img width="200" height="200" class="rounded-circle" src="http://172.16.161.100/storego/StoregoAllocationV2/assets/images/'.$currentPhoto.'" alt="#" /></div>';
                            ?>
                              <div class="col-md-4">
                                 <div class="profile_contant margin_top_50">
                                    <div class="contact_inner">
                                       <?php 
                                          $get_details=$this->Bookkeeper_Model->get_profile($_SESSION['id']);
                                          foreach($get_details as $details)
                                          {
                                             echo'<h2>'.$details['firstname'].'&nbsp;'.$details['lastname'].'</h2><br>
                                                   <ul class="list-unstyled">
                                                      <li style="font-size:18px;">Username : '.$details['username'].'</li>
                                                      <li style="font-size:18px;">BU Handled : '.$details['store_name'].'</li>
                                                      <li style="font-size:18px;">Position : '.$details['designation'].'</li>
                                                   </ul>';
                                          }
                                       ?>
                                    </div>
                          
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="full inner_elements margin_top_10">
                                    <div class="tab_style2">
                                       <div class="tabbar">
                                          <nav>
                                             <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#recent_activity" role="tab" aria-selected="true">Change Photo</a>
                                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#project_worked" role="tab" aria-selected="false">Change Password</a>
                                             </div>
                                          </nav>
                                          <div class="tab-content" id="nav-tabContent">
                                             <div class="tab-pane fade show active" id="recent_activity" role="tabpanel" aria-labelledby="nav-home-tab">
                                                <div class="msg_list_main">
                                                   <div class="form-group">
                                                     <div class="custom-file">
                                                          <input type="file" class="custom-file-input" id="file1" name="file1">
                                                          <label class="custom-file-label" for="file1">Choose Image</label>
                                                      </div>

                                                   </div>
                                                   <div class="form-group">
                                                      <label for="password">Password</label>
                                                      <input type="password" class="form-control" id="password" name="password" required>
                                                      <small class="form-text text-muted"><span class="fa fa-info text-primary"></span> Confirm changes by typing your password</small>
                                                  </div>
                                                  <br><br>
                                                      <button type="submit" onclick="updatePhoto()" class="btn btn-primary">Submit</button>
                                                </div>
                                             </div>

                                       <div class="tab-pane fade" id="project_worked" role="tabpanel" aria-labelledby="nav-profile-tab">
                                          <div class="form-group">
                                             <label for="old_password">Old Password</label>
                                             <input type="password" class="form-control" id="old_password" name="old_password" required>
                                          </div>
                                          <div class="form-group">
                                             <label for="new_password">New Password</label>
                                             <input type="password" class="form-control" id="new_password" onkeyup="validate_js()" name="new_password" required>
                                             <small class="form-text text-muted"><span class="fa fa-exclamation-circle text-info"></span> NOTE: Alphanumeric with special characters. Should have atleast 1 character of upper and lowercase. Minimum of 8 characters.</small>
                                          </div>
                                          <div class="form-group">
                                             <label for="repeat_password">Repeat Password</label>
                                             <input type="password" class="form-control" id="repeat_password" onkeyup="validate_js2()" name="repeat_password" required>
                                             <small class="form-text text-muted"><span class="fa fa-exclamation-triangle text-warning"></span> Make sure you matched the confirmation of your new password.</small>
                                          </div>
                                            <button type="submit" id="submit_button" onclick="updatePassword()"class="btn btn-primary">Submit</button>
                                       </div>
                                    </div>
                                  </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  </div>
               </div>
            <div class="col-md-2"></div>
         </div>
         <!-- end row -->
      </div>

   <script type="text/javascript">
      $(document).ready(function () {
          // When the file input changes
          $('#file1').on('change', function () {
              // Get the selected file name
              var fileName = $(this).val().split('\\').pop();
              // Update the label with the file name
              $(this).next('.custom-file-label').html(fileName);
          });
      });

      function validate_js()
      {
          var npass = $("#new_password").val();
         
          var pattern = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]+$/;
         
          if (pattern.test(npass)  && npass.length >= 8) {
            // Input is alphanumeric and special character
            $("#new_password").removeClass('invalid').addClass('valid');
            $("#submit_button").prop('disabled', false);
          } 
          else 
          {
            // Input is not alphanumeric and special character
            $("#new_password").removeClass('valid').addClass('invalid');
            $("#submit_button").prop('disabled', true);
          }
      }

      function validate_js2()
      {
          var rpass = $("#repeat_password").val();
         
          var pattern = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]+$/;
         
          if (pattern.test(rpass)  && rpass.length >= 8) {
            // Input is alphanumeric and special character
            $("#repeat_password").removeClass('invalid').addClass('valid');
            $("#submit_button").prop('disabled', false);
          } 
          else 
          {
            // Input is not alphanumeric and special character
            $("#repeat_password").removeClass('valid').addClass('invalid');
            $("#submit_button").prop('disabled', true);
          }
      }
   </script>