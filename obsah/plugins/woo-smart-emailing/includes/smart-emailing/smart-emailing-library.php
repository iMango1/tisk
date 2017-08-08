<?php

		if ( ! class_exists( 'Smart_Emailing' ) ) {
    
		class Smart_Emailing {
				
        /**
         * Smart Emailing Token
         *
         * @since 1.0.0        
         */                          
        public $smartemailing_token;
        
        /**
         * Smart Emailing Username
         *
         * @since 1.0.0        
         */                          
        public $smartemailing_username;
        
        /**
         * Constructor
         * 
         * @since 1.0.0                  
         */                          
        public function __construct($token,$username) {
        
          $this->smartemailing_token    = $token;
          $this->smartemailing_username = $username;
          
				}
        
        
        /**
         * Send request
         *
         * @since 1.0:0        
         */                          
        private function sendRequest($xml, $info) {
	        
         
           $ch = curl_init('https://app.smartemailing.cz/api/v2/');
	         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	         curl_setopt($ch, CURLOPT_POST, 1);
	         curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
	         $result = curl_exec($ch);
          
          
	       if ($result === false) {
         
           $note = 'Send request';
           $e = 'Chyba v zasilani XML requestu!';
           $this->save_log($e, $note);
		      
           return false;
	       }else{

		          /** @noinspection PhpUsageOfSilenceOperatorInspection */
		          $xml_doc = @simplexml_load_string($result); 

                if (!$xml_doc) {
			               $note = 'Load simple xml string';
                     $e    = 'Chyba v simplexml_load_string!';
                     $this->save_log($e, $note);
                     
                     return false;
		            }

		            if ($xml_doc->status == 'SUCCESS') {
     
                     $note = $info.': SUCCESS';
                     $e    = $xml_doc->data;
                     $this->save_log($e, $note);
      
                     return $xml_doc;
		            }else{
			               
                     $note = $info.': Error';
                     $e    = $xml_doc->errormessage;
                     $this->save_log($e, $note);
                  
                     return $xml_doc;
 		            } 
          }
        }

        
        /**
         * Echo helper
         *
         * @since 1.0.0        
         */                          
        private function v($result) {
	         echo $result;
	         die();
        }
        
        /**
         * Save log
         *          
         * @since 1.0.0   
         */     
        private function save_log($e, $note){ 
            
            $file     = SMARTDIR.'/log/response_log.txt';
            $current  = file_get_contents($file);
            $current .= date('D, d M Y H:i:s').' - '.$note.PHP_EOL;
            $current .= $e.PHP_EOL;
            file_put_contents($file, $current);
            
        }    
        
        /**
         * Test Credentials
         *
         * @since 1.0.0
         */                                   
        public function testCredentials(){
        
            $xml = '
                    <xmlrequest>
                      <username>'.$this->smartemailing_username.'</username>
                      <usertoken>'.$this->smartemailing_token.'</usertoken>
                      <requesttype>Users</requesttype>
                      <requestmethod>testCredentials</requestmethod>
                      <details>
                      </details>
                    </xmlrequest>
                  ';
            return $this->sendRequest($xml, 'testCredentials'); 
        
        }
        
        /**
         * Get contact list by id
         *
         * @since 1.0.0
         */                                   
        public function getContactListById($id){
        
            $xml = '
                    <xmlrequest>
                      <username>'.$this->smartemailing_username.'</username>
                      <usertoken>'.$this->smartemailing_token.'</usertoken>
                      <requesttype>ContactLists</requesttype>
                      <requestmethod>getContacts</requestmethod>
                      <details>
                      <id>'.$id.'</id>
                      </details>
                    </xmlrequest>
                  ';
            return $this->sendRequest($xml, 'getContactListById'); 
        
        }
        
        /**
         * Get all contact lists
         *
         * @since 1.0.0
         */                                   
        public function getAllContactsLists(){
        
            $xml = '
                    <xmlrequest>
                      <username>'.$this->smartemailing_username.'</username>
                      <usertoken>'.$this->smartemailing_token.'</usertoken>
                      <requesttype>ContactLists</requesttype>
                      <requestmethod>getAll</requestmethod>
                      <details>
                      </details>
                    </xmlrequest>
                  ';
            return $this->sendRequest($xml, 'getAllContactsLists'); 
        
        }
        
        /**
         * Get contact by id
         *
         * @since 1.0.0
         */                                   
        public function getContact($id){
        
            $xml = '
                    <xmlrequest>
                      <username>'.$this->smartemailing_username.'</username>
                      <usertoken>'.$this->smartemailing_token.'</usertoken>
                      <requesttype>ContactLists</requesttype>
                      <requestmethod>getOne</requestmethod>
                      <details>
                      <id>'.$id.'</id>
                      </details>
                    </xmlrequest>
                  ';
            return $this->sendRequest($xml, 'getContact'); 
        
        }
        
        /**
         * Create contact
         *
         * @since 1.0.0
         */                                   
        public function createContactList($id){
        
            $xml = '
                    <xmlrequest>
                      <username>'.$this->smartemailing_username.'</username>
                      <usertoken>'.$this->smartemailing_token.'</usertoken>
                      <requesttype>ContactLists</requesttype>
                      <requestmethod>create</requestmethod>
                      <details>
	                      <name>List po API</name>
	                      <trackedDefaultFields>a:2:{i:0;s:7:"updated";i:1;s:11:"blacklisted";}</trackedDefaultFields>
		                    <sendername>Martin Strouhal</sendername>
		                    <senderemail>martin@smartemailing.cz</senderemail>
		                    <replyto>martin@smartemailing.cz</replyto>
                      </details>
                    </xmlrequest>
                  ';
            return $this->sendRequest($xml, 'createContact'); 
        
        }
        
        /**
         * Delete contact
         *
         * @since 1.0.0
         */                                   
        public function deleteContact($id){
        
            $xml = '
                    <xmlrequest>
                      <username>'.$this->smartemailing_username.'</username>
                      <usertoken>'.$this->smartemailing_token.'</usertoken>
                      <requesttype>ContactLists</requesttype>
                      <requestmethod>delete</requestmethod>
                      <details>
	                      <id>'.$id.'</id>
	                      <removecontacts>1</removecontacts><!-- optional -->
                      </details>
                    </xmlrequest>
                  ';
            return $this->sendRequest($xml, 'deleteContact'); 
        
        }
        
        /**
         * Create contact
         *
         * @since 1.0.0
         */                                   
        public function createContact($args){
        
            $xml = '
                    <xmlrequest>
                      <username>'.$this->smartemailing_username.'</username>
                      <usertoken>'.$this->smartemailing_token.'</usertoken>
                      <requesttype>Contacts</requesttype>
                      <requestmethod>createupdate</requestmethod>
                      <details>
                        <emailaddress>'.$args['email'].'</emailaddress>
		                    <language>'.$args['language'].'</language>
		                    <blacklisted>0</blacklisted>
		                    <name>'.$args['name'].'</name>
		                    <surname>'.$args['surname'].'</surname>
		                    <titlesbefore></titlesbefore>
		                    <titlesafter></titlesafter>
		                    <salution></salution> 
		                    <company></company>
		                    <street>'.$args['street'].'</street>
		                    <town>'.$args['town'].'</town>
		                    <country>'.$args['country'].'</country>
		                    <postalcode>'.$args['postalcode'].'</postalcode>
		                    <notes></notes>
		                    <phone>'.$args['phone'].'</phone>
		                    <cellphone>'.$args['phone'].'</cellphone>
		                    <softbounced>0</softbounced>
		                    <hardbounced>0</hardbounced>
                        <contactliststatuses>
			                   <item>
				                   <id>'.$args['list_id'].'</id>
				                   <status>confirmed</status>
			                   </item>
		                   </contactliststatuses>
                      </details>
                    </xmlrequest>
                  ';
            return $this->sendRequest($xml, 'createContact'); 
        
        }
        
        

        
			}//End class 
  }


?>