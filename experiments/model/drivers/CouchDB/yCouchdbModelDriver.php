<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * yCouchdbModelDriver
 * 
 * Automatic properties:
 * _id
 * _rev
 *
 * @package yuki
 * @subpackage model
 * @author olamedia
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class yCouchdbModelDriver extends yDocumentModelDriver{
    public function execute($query){
        switch ($query->getType()){
            case 'SELECT':
                $this->documentGet($query->getDocumentId());
                break;
            case 'INSERT':
                $this->documentCreate($query->getDataObject(), $query->getDocumentId());
                break;
            case 'UPDATE':
                $this->documentUpdate($query->getDocumentId(), $query->getDataObject());
                break;
            case 'DELETE':
                $this->documentDelete($query->getDocumentId());
                break;
        }
    }
    public function documentGet($documentId){
        // GET /somedatabase/some_doc_id
    }
    public function documentGetRevisionList($documentId){
        // GET /somedatabase/some_doc_id?revs=true
    }
    public function documentGetRevision($documentId, $revisionId){
        // GET /somedatabase/some_doc_id?rev=946B7D1C
    }
    public function documentGetInfo($documentId){
        // HEAD /somedatabase/some_doc_id
    }
    public function documentCreate($data, $documentId = null){
        // PUT /somedatabase/some_doc_id
        // POST /somedatabase/
    }
    public function documentUpdate($documentId, $data){
        // PUT /somedatabase/some_doc_id
    }
    public function documentDelete($documentId){
        // DELETE /somedatabase/some_doc?rev=1582603387
    }
    public function documentCopy($documentId, $targetDocumentId, $targetRevisionId = null){
        // COPY /somedatabase/some_doc HTTP/1.1
        // Destination: some_other_doc
        // COPY /somedatabase/some_doc HTTP/1.1
        // Destination: some_other_doc?rev=rev_id
    }
    public function documentAttachFile($documentId, $contentType, $filename){
        
    }
    public function documentAttachData($documentId, $contentType, $data){
        
    }
}

