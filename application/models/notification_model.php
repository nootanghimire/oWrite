<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification_model extends CI_Model {


	public function __construct(){
		$this->load->database();
	}

	public function fetchNotifications($username){
		$username = sprintf("%s",mysql_real_escape_string($username));
		$query = "SELECT * FROM notifications WHERE NotifyTo='$username' AND Seen=0;";
		$q =$this->db->query($query);
		$data = $q->result();
		return $data;
	}

	public function getNumNotification($username){
		$count = 0;
		$data = self::fetchNotifications($username);
		foreach ($data as $key => $datum) {
			$count++;
		}
		return $count;
	}

	public function setNotification($to, $text, $link){
		$insertData= array(array(
							"NotifyTo"=>$to,
							"NotifyFor"=>$text,
							"NotifiedOn"=>time(),
							"NotifyClickLink"=>$link,
							"Seen"=>0
							)
						);
		echo $this->db->insert_batch('notifications', $insertData);
	}

	public function MakeNotificationSeen($notification_id){
		if(is_array($notification_id)){
			foreach ($notification_id as $value) {
				$query = "UPDATE notifications SET Seen=1 WHERE NotifyId=$value;";
				$this->db->query($query);
			}
		} else {
			$query = "UPDATE notifications SET Seen=1 WHERE NotifyId=$notification_id;";
			$this->db->query($query);
		}
		
	}

	
	
}