<?php
include 'top.php';
$debug = true;

/* this example creates a list box from our database.
 * Four step process

  Create your database object using the appropriate database username
  Define your query. In this example we open the file that contains the query.
  Execute the query
  Prepare output and loop through array

 */
$yourURL = $domain.$phpSelf;
//initialize value
$mountain = "Killington";
$userEmail = get_current_user()."@uvm.edu";
$liftWait = "Time in minutes";
if($debug)
    print"<p>". $userEmail."</p>";
$mountainERROR = false;
$userEmailERROR = false;
$liftWaitERROR = false;
$errorMsg = array();

if (isset($_POST["btnSubmit"]))
{
    //Secruity
    if (!(securityCheck($path_parts, $yourURL, true))) {
       $msg = "<p>Sorry you cannot access this page. ";
      $msg.= "Security breach detected and reported</p>";
       die($msg);
   }
    if (debug)
        print "<p>hello</p>";
    $liftWait = filter_var($_POST["txtLiftWait"]);
    
  if(!$errorMsg)
  {
      if($debug)
          print"<p> valid</p>";
      $dataEntered = false;
      try{
     if($debug)
         print"<p>Form passed error validation</p>";
     $insertQuery = 'INSERT INTO tblUserMountainReview SET fnkMountainId =?, fnkUserEmail=?,fldLiftWait=?,fldDifficulty=?, fldCondition=?,fldRating=?';
     $findMountainIdQuery = "SELECT pmkMountainId FROM tblMountains WHERE fldName =".$mountain;
     $temp = $thisDatabaseReader->select($query,"", 0, 0, 0, 0, false, false);
     $mountainId = print_r($temp);
     if($debug)
         print"<p> mountainId:".$mountainId."</p>";
      
     $data = array($mountainId,$userEmail,$liftWait,0,"yo",0);
      if ($debug) {
                print "<p>sql " . $query;
                print"<p><pre>";
                print_r($data);
                print"</pre></p>";
      }
     $results = $thisDatabaseWriter->insert($insertQuery, $data);
     $dataEntered= true;
     if($debug)
         print"<p>finished</p>";
      }//ends try
      catch (PDOException $e){
          $thisDatabase->db->rollback();
            if ($debug)
                print "Error!: " . $e->getMessage() . "</br>";
            $errorMsg[] = "There was a problem with accpeting your data please contact us directly.";
        }
      }//ends catch

      }
  //End if form is valid
//End button submit
?>

<form action= "<?php print $phpSelf; ?>"
      method ="post"
      id="frmMountainReview">
    <fieldset class="warpper">
        <Legend>Enter your review of a mountain</Legend>
        <?php
        $query  = "SELECT DISTINCT fldName ";
$query .= "FROM tblMountains ";
$query .= "ORDER BY  fldName";
        $mountains = $thisDatabaseReader->select($query, "", 0, 1, 0, 0, false, false);

print '<label for="lstMountains">Select a mountain to review ';
print '<select id="lstMountains" ';
print '        name="lstMountains"';
print '        tabindex="10" >';


foreach ($mountains as $row) {

    print '<option ';
    if ($mountain == $row["fldMountain"])
        print " selected='selected' ";

    print 'value="' . $row["fldName"] . '">' . $row["fldName"];

    print '</option>';
}

print '</select></label>';
?>
        <fieldset class="mountainReview">
                        <legend>Thoughts about the mountain</legend>

                        <label for="txtLiftWait" class="notrequired">Average lift wait time in minutes
                            <input type="text" id="txtLiftWait" name="txtLiftWait"
                                   value="<?php print $LiftWait; ?>"
                                   tabindex="20" maxlength="45" placeholder="Lift wait in minutes"
                                   <?php if ($liftWaitERROR) print 'class="mistake"'; ?>
                                   onfocus="this.select()"
                                   >
                        </label>
        </fieldset><!-- ends the mountain review section -->
        <fieldset class="buttons">
            <input type="submit" id="btnSubmit" name="btnSubmit" value="Review" tabindex="1000" class="button">
        
        </fieldset>
        <?php
print "</fieldset>";//Ends Wrapper fieldset

print '</form>';
include 'footer.php';
?>