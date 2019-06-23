<?php
if(isset($_POST['submit'])){
    $subject=$_POST['subject'];
    $text=$_POST['elvismail'];
    $from='825834292@qq.com';
    $output_form=false;

    if(empty($subject)&&empty($text)){
        echo 'You forget the email subject and body text.<br/>';
        $output_form=true;   
        }
    if(empty($subject)&& (!empty($text))){
        echo 'You forget the email subject.<br/>';   
        $output_form=true;
        }
    if((!empty($subject))&& empty($text)){
        echo 'You forget the body text.<br/>';   
        $output_form=true;
        }
    if((!empty($subject))&& (!empty($text))){
        $dbc=mysqli_connect('localhost','root','','elvis_store') or die('error connecting to ');
        $query="SELECT * FROM email_list";
        $result=mysqli_query($dbc,$query);
        while($row=mysqli_fetch_array($result)){
            $first_name=$row['first_name'];
            $last_name=$row['last_name'];
            $msg="Drea $first_name $last_name,\n $text";
            $to=$row['email'];
            mail($to,$subject,$msg,'From:'.$from);
            echo 'email send to:'.$to.'<br/>';
            }      
        }
      }
      else{
          $output_form=true;
      }
    if($output_form){
    ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="subject">Subject</label>
    <input type="text" name="subject" size="60" value="<?php echo $subject ?>"/><br/>
    <label for="elvismail">body of email</label>
    <textarea name="elvismail" rows="8" cols="60"></textarea><br/>
    <input type="submit" name="submit">
    <?php
    }
    ?>
