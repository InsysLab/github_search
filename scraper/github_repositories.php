<?php
/**
 * Class for retrieving Github public repositories
 *
 */
class Github_Repositories{
		
	/**
	 * Retrieve repositories
	 * @access public
	 */
	public function getRepos(){
		$result = $this->_getRepos();
		$result = json_decode($result);
		
		$list = array();
		foreach($result->items as $repo){
			if( $repo->private != false ) continue;
			
			$new_repo = array(
						'id' 		  => $repo->id,
						'name' 		  => $repo->name,
						'url'  		  => $repo->html_url,
						'description' => $repo->description,
						'created' 	  => $repo->created_at,
						'pushed' 	  => $repo->pushed_at,
						'stars' 	  => $repo->stargazers_count
					);
			
			$list[] = $new_repo;
		}
		
		return $list;
	}

	/**
	 * Request the API URL
	 * @access private
	 */
	private function _getRepos(){
		$url = "https://api.github.com/search/repositories";
		$url .= "?q=language:php+stars:>0&sort=stars&order=desc&per_page=40";
		return $this->request($url);
	}
	
	/**
	 * Sends request using curl
	 * @param string  The URL target
	 * @access public
	 */
	public function request($url){
		$ch = curl_init();
		
		$headers = array(
			'Accept: application/json',
			'Content-Type: application/json',
		);
	
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, "insyslab.github-api");
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);

		/* Used to raised the request rate limit */
		//curl_setopt($ch, CURLOPT_USERPWD, "github_username:github_password");  
		
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		
		$content = curl_exec($ch);
		curl_close($ch);
		return $content;		
	}
	
}