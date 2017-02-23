<?php
namespace StudentsApp;

use Exception;

class View 
{
    private $headerFile;
    private $contentFile;
    private $footerFile;    
    private $data = [];
    
    public function __construct($contentFile = "", $headerFile = "views/header.php", $footerFile="views/footer.php")
    {
        $this->headerFile = $headerFile;
        $this->contentFile = $contentFile;
        $this->footerFile = $footerFile;        
    }
    
    public function setHeaderFile($headerFile)
    {
        $this->headerFile = $headerFile;
    }
    
    public function getHeaderFile()
    {
        return $this->headerFile;
    }
    
    public function setContentFile($contentFile)
    {
        $this->contentFile = $contentFile;
    }
    
    public function getContentFile()
    {
        return $this->contentFile;
    }
    
    public function setFooterFile($footerFile)
    {
        $this->footerFile = $footerFile;
    }
    
    public function getFooterFile()
    {
        return $this->footerFile;
    }
    
    public function setData($key, $value)
    {
        $this->data[$key] = $value;               
    }
    
    public function getData($key)
    {
        return $this->data[$key];      
    }
    
    public function renderView()
    {
        if(!file_exists($this->headerFile)){
            throw new Exception("Template Header File " . $this->headerFile . " does not exist");
        }
        if(!file_exists($this->contentFile)){
            throw new Exception("Template Content File " . $this->contentFile . " does not exist");
        }
        if(!file_exists($this->footerFile)){
            throw new Exception("Template Footer File " . $this->footerFile . " does not exist");
        }
                
        extract($this->data);
        
        include($this->headerFile);
        include($this->contentFile);
        include($this->footerFile);        
        
    }
    
}
