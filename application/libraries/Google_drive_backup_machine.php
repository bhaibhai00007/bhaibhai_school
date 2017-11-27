<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include APPPATH."libraries/google-api-php-client/Google_Client.php";
include APPPATH."libraries/google-api-php-client/contrib/Google_DriveService.php";

class Google_drive_backup_machine{
    protected $scope = array('https://www.googleapis.com/auth/drive');
	
    private $_service;
    
    public function init( $clientId, $serviceAccountName, $key ) {
            $client = new Google_Client();
            $client->setClientId( $clientId );

            $client->setAssertionCredentials( new Google_AssertionCredentials(
                            $serviceAccountName,
                            $this->scope,
                            file_get_contents( $key ) )
            );


            $this->_service = new Google_DriveService($client);
    }

    public function __get( $name ) {
            return $this->_service->$name;
    }

    public function createFile( $name, $mime, $description, $content, Google_ParentReference $fileParent = null ) {
            $file = new Google_DriveFile();
            $file->setTitle( $name );
            $file->setDescription( $description );
            if($mime!="application/vnd.google-apps.folder"){
                $file->setMimeType( $mime );
            }else{
                $file->setMimeType( $mime );
            }
            
            if( $fileParent ) {
                    $file->setParents( array( $fileParent ) );
            }

            $createdFile = $this->_service->files->insert($file, array(
                            'data' => $content,
                            'mimeType' => $mime,
            ));

            return $createdFile['id'];
    }

    public function createFileFromPath( $path, $description, Google_ParentReference $fileParent = null ) {
            $fi = new finfo( FILEINFO_MIME );
            $mimeType = explode( ';', $fi->buffer(file_get_contents($path)));
            $fileName = preg_replace('/.*\//', '', $path );

            return $this->createFile( $fileName, $mimeType[0], $description, file_get_contents($path), $fileParent );
    }


    public function createFolder( $name ) {
            return $this->createFile( $name, 'application/vnd.google-apps.folder', null, null);
    }

    public function setPermissions( $fileId, $value, $role = 'writer', $type = 'user' ) {
        $perm = new Google_Permission();
        $perm->setValue( $value );
        $perm->setType( $type );
        $perm->setRole( $role );

        $this->_service->permissions->insert($fileId, $perm);
    }

    public function getFileIdByName( $name ) {
        $files = $this->_service->files->listFiles();
        foreach( $files['items'] as $item ) {
            if( $item['title'] == $name ) {
                return $item['id'];
            }
        }
        return false;
    }
    
    function fileParent($folderId){
        //include_once APPPATH."libraries/google-api-php-client/Google_Client.php";
        //include_once APPPATH."libraries/google-api-php-client/contrib/Google_DriveService.php";
        $fileParent = new Google_ParentReference();
        $fileParent->setId( $folderId );
        return $fileParent;
    }
    
    function getParent($folderId){
        $fileParent = new Google_ParentReference();
        $fileParent->setId( $folderId );
        $ParentLink=$fileParent->getParentLink( $folderId );
        return $ParentLink;
    }
}