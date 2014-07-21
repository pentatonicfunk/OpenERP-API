
<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8"/>
   <title>Dashboard I Admin Panel</title>
   
   <link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
   <link rel="stylesheet" type="text/css" href="css/global.css" />
   <!--[if lt IE 9]>
   <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
   <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
   <![endif]-->
   <script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
   <script src="js/hideshow.js" type="text/javascript"></script>
   <script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
   <script type="text/javascript" src="js/jquery.equalHeight.js"></script>
   <script type="text/javascript">
   $(document).ready(function() 
      { 
           $(".tablesorter").tablesorter(); 
       } 
   );
   $(document).ready(function() {

   //When page loads...
   $(".tab_content").hide(); //Hide all content
   $("ul.tabs li:first").addClass("active").show(); //Activate first tab
   $(".tab_content:first").show(); //Show first tab content

   //On Click Event
   $("ul.tabs li").click(function() {

      $("ul.tabs li").removeClass("active"); //Remove any "active" class
      $(this).addClass("active"); //Add "active" class to selected tab
      $(".tab_content").hide(); //Hide all tab content

      var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
      $(activeTab).fadeIn(); //Fade in the active ID content
      return false;
   });

});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
    </script>

</head>
<body>
   <header id="header">
      <hgroup>
         <h1 class="site_title"><a href="index.html">Website Admin</a></h1>
         <h2 class="section_title">Dashboard</h2><div class="btn_view_site"><a href="http://www.medialoot.com">View Site</a></div>
      </hgroup>
   </header> <!-- end of header bar -->
   
   <section id="secondary_bar">
      <div class="user">     
        <p>ADMIN</p>
         <!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
      </div>
      <div class="breadcrumbs_container">
         <article class="breadcrumbs"><a href="index.html">Home</a> <div class="breadcrumb_divider"></div> <a class="current">Dashboard</a></article>
      </div>
   </section><!-- end of secondary bar -->
      <?php include"option.php"; ?>
   <section id="main" class="column" >
      <!-- h4 class="alert_info">Welcome to Dashboard Admin Website --><!-- end of stats article --><!-- end of content manager article --><!-- end of messages article -->

</br>
</br>
      <a  href="tambah.php" ><button type="submit">TAMBAH EMPLOYEE</button> </a>
<?php

$host = "localhost";
$port = "8069";
$username = "admin";
$password = "admin";


require_once 'xmlrpc.inc';
class OpenERPXmlrpc {
   private $user, $password, $database, $services, $client, $res, $msg, $id;
   function __construct($usr, $pass, $db, $server) {
      $this->user = $usr;
      $this->password = $pass;
      $this->database = $db;
      $this->services = $server;
      $this->client = new xmlrpc_client($this->services.'common');
      $this->msg = new xmlrpcmsg('login');
      $this->msg->addParam(new xmlrpcval($this->database, "string"));
      $this->msg->addParam(new xmlrpcval($this->user, "string"));   
      $this->msg->addParam(new xmlrpcval($this->password, "string"));
      $this->res =  &$this->client->send($this->msg);
      if(!$this->res->faultCode()){
         $this->id = $this->res->value()->scalarval(); 
         //echo "berhasil login dengan".$this->id;
      }
      else {
         echo "Unable to login ".$this->res->faultString();
         exit;
      }
   }
   function data_uri($file, $mime) 
    {  
        $contents = file_get_contents($file);
        $base64   = base64_encode($contents); 
        return ('data:' . $mime . ';base64,' . $base64);
    }

   function read($post = null) {
      $this->client = new xmlrpc_client($this->services.'object');
      if(empty($post)) {
         echo "<h1>";      
         $ids_read = array(
            new xmlrpcval('1', 'int'), new xmlrpcval('2', 'int'), new xmlrpcval('3', 'int'), new xmlrpcval('4', 'int'), new xmlrpcval('5', 'int'), new xmlrpcval('6', 'int'), new xmlrpcval('7', 'int'), new xmlrpcval('8', 'int'), new xmlrpcval('9', 'int'), new xmlrpcval('10', 'int'));
         $key = array(new xmlrpcval('id','integer') , new xmlrpcval('image', 'string'), new xmlrpcval('job_id', 'string'), new xmlrpcval('name', 'string'), new xmlrpcval('mobile_phone', 'string'), new xmlrpcval('work_location', 'string'));
         $this->msg = new xmlrpcmsg('execute');
         $this->msg->addParam(new xmlrpcval($this->database, "string"));
         $this->msg->addParam(new xmlrpcval(1, "int"));
         $this->msg->addParam(new xmlrpcval($this->password, "string"));
         $this->msg->addParam(new xmlrpcval("hr.employee","string"));
         $this->msg->addParam(new xmlrpcval("read", "string"));
         $this->msg->addParam(new xmlrpcval($ids_read, "array"));
         $this->msg->addParam(new xmlrpcval($key, "array"));
         $this->res = &$this->client->send($this->msg);
         if(!$this->res->faultCode()) {
            $read_html = '<table width="20%" border="0" cellpadding="4" cellspacing="4" align="center">';
            $scalval = $this->res->value()->scalarval();
            foreach ($scalval as $keys => $values) {
               $value = $values->scalarval();
               '<section id="right">
                   <div class="gcontent" high>
                   <div class="head"><h1>Friends List</h1></div>
                   <div class="boxy">
                      <p>employee total</p>';
               
               $read_html .= '
               <td>


                <div class="Employee List">
                  <div class="friend">
                  <td><td><td><td><td><td><td><td><td>
                    <a href="profil_admin.php?login='.$value['id']->scalarval().'"><img src="data:image/gif;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" width="60" height="100" alt="embedded folder icon"></a><span class="friendly"><a href="profil_admin.php?login='.$value['id']->scalarval().'">'.$value['name']->scalarval().'</a></span>
                    </span>
                  </td>
                  </div>
               </td>';
          }

              '</div>
                  <span><a href="#">See all...</a></span>
                </div>
                </div>
             </section>';

            $read_html .= '</table>';
            return $read_html;
         }
         else {
            return "Not read recode from partner table <br />".$this->res->faultString();
             echo "</h1>";
         }
      }
   }

}
      $cnt = new OpenERPXmlrpc($username, $password, 'erp', 'http://'.$host.':'.$port.'/xmlrpc/');

      echo $cnt->read();
?>
   
     <div class="clear"></div><!-- end of post new article --><!-- end of styles article -->
     <div class="spacer"></div>
   </section>
</body>
</html>