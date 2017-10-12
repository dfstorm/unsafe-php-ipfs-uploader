<?php
    require_once('ipfs.php');
    class uipfs {
      public function upload()
      {
        $isAuth = false;
        if(isset($_POST['secretKey']))
        {
          $arrKeys = array(
            "please_do_something_better_than_this" // simple test key
          );
          foreach ($arrKeys as $key ) {
            if($key == $_POST['secretKey'])
            {
              // TODO: Add more security
              $isAuth = true;
            }
          }
        }
        if(!$isAuth) {
          return json_encode(array("iCode" => 0, "recivedkey" => (isset($_POST['secretKey'])?$_POST['secretKey']:"")));
        }
        // TODO: Handle ipfs errors
        $item = file_get_contents($_FILES["upload"]["tmp_name"]);
        $ipfs = new IPFS("localhost", "8080", "5001");
        return json_encode(array("iCode" => 1, "hash" => $ipfs->add($item)));
      }
    }
    $ipfslift = new uipfs();
    header('Content-type: application/json');
    print_r($ipfslift->upload());
 ?>
