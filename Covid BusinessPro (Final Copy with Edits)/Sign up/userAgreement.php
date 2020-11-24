<html>
    <?php
        session_start();
    ?>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Agreement</title>
        <link rel="stylesheet" type="text/css" href="style4.css">
        <script type="text/javascript" src="Questionairre.js"></script>  
    </head>
</html>
<body>  
    <div class="navigationBar">
        <div class="logo">
            Covid BusinessPro
        </div>
      </div>
      <?php if($_SESSION['type'] !== null){?>
      <h2>Privacy <?php if ($_SESSION['type']=='0'){?>User <?php }?>Agreement</h2>
      <?php }else{ ?>
      <h2> Please login first. Thank you </h2>    
      <?php }?>   
    <div class="signup_container2 center">
        <div class="signup_card2">
            <form name="agreement" action="userAgreement.php" method="POST">
                <?php
                    if($_SESSION['type']=='0'){ ?>
                    <textarea style="overflow-wrap: normal;width: 360px; margin-left: auto;margin-right: auto; margin-top: 4%; height: 400px; overflow: auto;"  readonly>By agreeing, you accept responsibility for maintaining the confidentiality of the password and account, and are responsible for all activities that occur under your password or account. You agree to (a) immediately notify Covid BusinessPro of any unauthorized use of your password or account or any other breach of security, and (b) ensure that you exit from your account at the end of each session.You agree that you are responsible for actions and communications undertaken under your account. Covid BusinessPro takes no responsibility and assumes no liability for any Content uploaded or otherwise transmitted by or to you or by or to any third-party, or for any mistakes, defamation, slander, libel, omissions, falsehoods, infringement, obscenity, pornography or profanity you or a third party may encounter. You agree to waive any claims against Covid BusinessPro and its affiliates, contractors, agents and employees for losses, damages and injuries which are based on or relate to communications, Content or materials on the Site. You agree to indemnify Covid BusinessPro and its affiliates from all claims and expenses, including reasonable attorney’s fees, which claims are based on or arise from your violation of any of the provisions of this Agreement.
                    You agree that you will use this Site and any products and stamps, ordered on this Site in accordance with all applicable Canadian federal, provincial and local laws, statutes, regulations and ordinances and will not take any action that harms or violates the rights of any person or entity. Your privacy is very important to Covid BusinessPro. Users of this Site should refer to our privacy policy for information about how Covid BusinessPro collects and uses personal information. By accepting this Agreement you expressly consent to Covid BusinessPro’s disclosure and use of your personal information as described in the Privacy Policy</textarea>                   
                    <?php }else if($_SESSION['type']=='1'){?>
                    <textarea style="overflow-wrap: normal;width: 360px; margin-left: auto;margin-right: auto; margin-top: 4%; height: 400px; overflow: auto;"  readonly> As an Human resource Manager, you agree to maintain confidentiality regarding User data and Medical conditions and Act only when necessary. You are responsible for maintaining the confidentiality of the password and account, and are responsible for all activities that occur under your password or account. You agree to (a) immediately notify Covid BusinessPro of any unauthorized use of your password or account or any other breach of security, and (b) ensure that you exit from your account at the end of each session.You agree that you are responsible for actions and communications undertaken under your account. Covid BusinessPro takes no responsibility and assumes no liability for any Content uploaded or otherwise transmitted by or to you or by or to any third-party, or for any mistakes, defamation, slander, libel, omissions, falsehoods, infringement, obscenity, pornography or profanity you or a third party may encounter. You agree to waive any claims against Covid BusinessPro and its affiliates, contractors, agents and employees for losses, damages and injuries which are based on or relate to communications, Content or materials on the Site. You agree to indemnify Covid BusinessPro and its affiliates from all claims and expenses, including reasonable attorney’s fees, which claims are based on or arise from your violation of any of the provisions of this Agreement. You agree that you will use this Site and any products and stamps, ordered on this Site in accordance with all applicable Canadian federal, provincial and local laws, statutes, regulations and ordinances and will not take any action that harms or violates the rights of any person or entity. Your privacy is very important to Covid BusinessPro. Users of this Site should refer to our privacy policy for information about how Covid BusinessPro collects and uses personal information. By accepting this Agreement you expressly consent to Covid BusinessPro’s disclosure and use of your personal information as described in the Privacy Policy.</textarea>                   
                    <?php } ?>  
                    <br>
                <input type="checkbox" name="agreeForm" onclick="if(this.checked){this.form.submit()}"> I agree to the following conditions</input>
            </form>
        </div>
    </div>
   <?php
        if(isset($_POST['agreeForm'])){
            if($_SESSION['type']=='0'){
                echo "<script type='text/javascript'> document.location = 'Questionairre.php'; </script>";
            }
            else if($_SESSION['type']=='1'){
                echo "<script type='text/javascript'> document.location = 'Main.php'; </script>";
            }
        }     
   ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>    
</body>
