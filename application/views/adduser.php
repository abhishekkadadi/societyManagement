<script type="text/javascript">


   
   
   function check() {
   	var usertype=$('input[name=optradio]:checked').val();
    var buildings=document.getElementById("faculty").value;
    var flatno=document.getElementById("flat_no").value;
    //flat_no
    if ($('input#membercheck').is(':checked')) { 
                    if(flatno && buildings){
                       return true;
                      }else{
                        return false;
                      }
                    }else{
                       return true;
                    }
   
            } 	


</script>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Parkinfinia

        </h1>

    </section>
    <section class="content" style="min-height: 0px;">
        <div class="row" >
            <div class="col-md-12">

                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">Add New User</h3>
                    </div>
                    <div class="box-body">
                    <form action="" method="post" id="addUser" enctype="multipart/form-data" name="add_product" class="form-inline" name="myForm"> 
                            <div class="form-group" style="display: block">                                
                               <label class="sr-only" for="Source Station">Create User *</label>
                                <div class="row">                                 
                                   <div class="radio col-md-4">
                                   <label><input type="radio" name="optradio" id="optradio" value="0">Add Member</label>
                                   </div>
                                   <div class="radio col-md-4">
                                   <label><input type="radio" name="optradio" id="optradio" value="1">Add Manager</label>
                                   </div>
                                   <div class="radio col-md-4">
                                   <label><input type="radio" name="optradio" id="optradio" value="2">Add Accountant</label>
                                   </div><br>
                                <div class="col-md-4">
                                <input type="text" id="name" style="width: 100%" name="name"  placeholder="Enter Name *" class="form-control">  
                                    </div>  
                                 <div class="col-md-4">
                                <input type="text" id="phoneno" style="width: 100%" name="phoneno"  placeholder="Enter user phone number *" class="form-control" >  
                                    </div> 
                                   <div class="col-md-4">
                                <input type="text" id="email" style="width: 100%" name="email"  placeholder="Enter user email address *" class="form-control" >  
                                    </div>
                                 <br><br>
                                 <div class="checkbox col-md-4" id="checkboxs" value="1">
                                <label><input type="checkbox" name="membercheck" id="membercheck" checked>Is society member</label>
                                </div><br><br>
                                 <div id="faculty_wrapper">
                                  <div class="faculty_row col-md-4">
                                <select id="faculty" name="faculty[]">
                                    <option value="">Select building</option>
                                    <?php foreach($data as $row):?>
                                    <option value="<?php echo $row->buildingId;?>"><?php echo $row->buildingName;?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="number" name="flatno[]" placeholder="Flat Number" id="flat_no">
                               
                            </div>

                            </div><br>
                            <div class="col-md-12" id="attach_more"><a href="#" id="add_more">Attach more flats to user</a> </div>
                                  
                                  <div  style="text-align: center; padding-top: 70PX;">
                                    <button  type="button" id="create_user" class="btn btn-primary" name="add_product" class="form-inline">Submit</button><br>
                                    <img  src=<?php echo base_url()."box.gif";?> alt="Smiley face" height="42" width="42" id="spinner">
                                    </div>
                                </div>
     
                        </form>
                        
                        <div class="form-group" style="margin-left: 13px;">
                            <div id="progressbox" style="display:none;"><div id="progressbar"></div><div id="statustxt">0%</div></div>
                             <label id='message'></label><br/>	
                              <label id='message2' ></label>
                            <div id="output" class="output"></div>
                        </div>
                    </div><!-- /.box-body -->
                </div>



            </div><!-- /.col (left) -->

        </div><!-- /.row -->
                                
    </section>


</div>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
            $(document).ready(function() {
            	 var $loading = $('#spinner').hide();
               $('.building').removeClass('active');
               $('.abuilding').removeClass('active');
               $('.nuser').addClass('active');
            	 $('.adduser').addClass('active');
            	 $('.que').removeClass('active');
            	 $('.switch').removeClass('active');
            	 $('.dstuall').removeClass('active');
            	// $('.aque').removeClass('active');



               $("#add_more").on('click', function(e){
                                  e.preventDefault(); // Prevent Default the event
                                  var clone = $(".faculty_row").eq(0).clone(); // clone only first item
                                  $("#faculty_wrapper").append(clone); // append it to our form
                });



                 $('#membercheck').change(function(){
        if(this.checked){
                        $('#faculty_wrapper').fadeIn('slow');
                        $('#attach_more').fadeIn('slow');
                  }else{
                        $('#attach_more').fadeOut('slow');
                        $('#faculty_wrapper').fadeOut('slow');
                       }
    });

                   $(document.body).on('click', '#create_user', function(e) {
    var usertype=$("input[name=optradio]:checked").val();
    var name=document.getElementById("name").value;
    var phoneno = document.getElementById("phoneno").value;
    var email=document.getElementById("email").value;
    var buildings=document.getElementById("faculty").value;
    if(name && phoneno && email){
     var value=check();
     if(value==true){

       $.ajax({
                            url: "<?php echo site_url('AddUsers/Newuser'); ?>",
                                     //base_url("index.php/Login/login_check"); 
                            type: "POST",
                            data: $('#addUser').serialize(),
                            cache: false,
                            beforeSend: function()
                            {  $loading.show();

                             },
                            success: function(response) {  
                              $loading.hide();
                           //alert(response);
                              if(response=='-1'){
                            document.getElementById('message').innerHTML  = 'Flat is already attached to other member';
                              }else if(response=='-2'){
                                document.getElementById('message').innerHTML  = 'Email already present';
                              }else if(response=='-3'){
                                document.getElementById('addUser').reset();
                              document.getElementById('message').innerHTML  = 'Data Successfully added';
                              }else if(response=='-4'){
                              document.getElementById('message').innerHTML  = 'Oops! Some thing went wrong';
                              }else if(response=='-5'){
                              document.getElementById('message').innerHTML  = 'Oops!Email sending failed please contact server providers';
                              }
                          }
                        });
     }else{
        document.getElementById('message').innerHTML  = 'Compulsary Fields Empty';
     }
  } else{
    document.getElementById('message2').innerHTML  = 'Compulsary Fields Empty';
   }
    
    });

});
            	</script>
            	
   