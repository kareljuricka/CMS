<?php

class Loader{

	private $root = "";

	private $libs_dir = "system/php/core/libs";
	private $classes_dir = "system/php/core/classes";

	public function __construct($root) {		
		// Register methodd "loader" as default auto-loading method
		spl_autoload_register(array($this, 'loader'));
		
		$this->root = $root;
	}

	/** Accepts name of required class or lib and search her location
	 * @param string name of required class or lib
	 */
	private function loader($object_name) {
			
		$route_libs =  $this->root . "/" . $this->libs_dir . "/" . $object_name;
		$route_classes =  $this->root . "/" . $this->classes_dir . "/" . $object_name; 	 	
		
		if (is_dir($route_libs)) {
			// It is system lib
			$this->loadLib($object_name);
		} elseif (is_dir($route_classes)) {
			// It is system class
			$this->loadClass($object_name);
		}			
	}

	/** Aceepts name of required lib and trying load her in newest version
	 * @param string name of required lib
	 */
	private function loadLib($lib_name){
		$route = $this->root . "/" . $this->libs_dir . "/" . $lib_name;
		$version = $this->selectLatestVersion($route);
		$file = $this->root . "/" . $this->libs_dir . "/" . $lib_name . "/" . $version . "/" . $lib_name . ".php";
		if (is_file($file)){
			require $file;
		}			
	}

	/** Aceepts name of required class and trying load her in newest version
	 * @param string name of required class
	 */
	private function loadClass($class_name){
		$route = $this->root . "/" . $this->classes_dir . "/" . $class_name;
		$version = $this->selectLatestVersion($route);
		$file = $this->root . "/" . $this->classes_dir . "/" . $class_name . "/" . $version . "/class." . $class_name . ".php";
		if (is_file($file)){
			require $file;
		}			
	}

	/** Pick up newest version in requested dir
	 * @param string target dir where will be search newest version
	 * @return string name of dir with newest version
	 */
	private function selectLatestVersion($target_dir){
		$return_array = array();
		if ($handle = opendir($target_dir)) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != "..") {
					$return_array[] = $entry;
				}
			}
			closedir($handle);
		}
		usort($return_array, array($this,'compareVersions'));
		return $return_array[0];
	}
	
	/** Version comparing
	 * @param string version
	 * @param string version
	 * @return int higher version
	 */
	private function compareVersions($a, $b){
		return version_compare($b, $a);
	}

}

?>