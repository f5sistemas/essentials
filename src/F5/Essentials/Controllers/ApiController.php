<?php


namespace F5\Essentials\Controllers;


use Response;
use Symfony\Component\HttpFoundation\Response as ResponseCodes;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


/**
 * @author Daniel Bonatti <daniel@f5sg.com.br>
 */
class ApiController extends BaseController {


    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * statusCode default
     * @var string
     */
    protected $statusCode = ResponseCodes::HTTP_OK;


    /**
     * get statusCode
     * @return String
     */
    public function getStatusCode() {
        return $this->statusCode;
    }


    /**
     * set statusCode
     * @param type $statusCode 
     * @return void / $this (chaining)
     */
    public function setStatusCode($statusCode) {
        $this->statusCode = $statusCode;

        return $this;
    }


    /**
     * @var String array
     */
    protected $responsesTypes = ['json', 'xml'];


    /**
     * @var String
     */
    protected $responseStandard = 'json';


   /**
    * return data to caller
    * @param type $data 
    * @param type|array $headers 
    * @param type|string $returnType 
    * @return returnType, contained in $responsesTypes
    */
    public function respond($data, $headers = [], $returnType = 'json') {

         if (!$returnType || !in_array($returnType, $this->responsesTypes)) 
            $returnType = 'json';

        return Response::$returnType($data, $this->getStatusCode(), $headers);
        
    }


    /**
     * return with 'not found data (404)'
     * @param type|string $message 
     * @return header of response
     */
    public function respondNotFound($message = 'Not found', $returnType = 'json') {

        $this->setStatusCode(ResponseCodes::HTTP_NOT_FOUND);

        return $this->respond([

            'error' => $message,
            'status_code' => $this->getStatusCode()

        ], [], $returnType);
        
    }


    /**
     * return with 'error' data
     * @param type $message 
     * @return type
     */
    public function respondWithError($message = 'Internal server error', $returnType = 'json') {

        $this->setStatusCode(ResponseCodes::HTTP_INTERNAL_SERVER_ERROR);

        return $this->respond([

            'error' => $message,
            'status_code' => $this->getStatusCode()

        ], [], $returnType);
        
    }


    /**
     * Description
     * @param type $message 
     * @param type|string $returnType 
     * @return type
     */
    public function respondWithSuccess($message, $returnType = 'json') {

        $this->setStatusCode(ResponseCodes::HTTP_OK);

        return $this->respond([

            'data' => $message,
            'status_code' => $this->getStatusCode()

        ], [], $returnType);
        
    }

    /**
     * Description
     * @param type $message 
     * @param type|string $returnType 
     * @return type
     */
    public function respondWithBadRequest($message, $returnType = 'json') {

        $this->setStatusCode(ResponseCodes::HTTP_BAD_REQUEST);

        return $this->respond([

            'validation' => $message,
            'status_code' => $this->getStatusCode()

        ], [], $returnType);
        
    }


    /**
     * Description
     * @param type $message 
     * @param type|string $returnType 
     * @return type
     */
    public function respondWithPaymentRequired($message, $returnType = 'json') {

        $this->setStatusCode(ResponseCodes::HTTP_PAYMENT_REQUIRED);

        return $this->respond([

            'payment_required' => $message,
            'status_code' => $this->getStatusCode()

        ], [], $returnType);
        
    }



    /**
     * return App\Model\User with data
     * @param type|null $user 
     * @param type|string $returnType 
     * @return JSON
     */
    public function respondWithAccepted($user = null, $returnType = 'json') {

        $this->setStatusCode(ResponseCodes::HTTP_ACCEPTED);

        return $this->respond([

            'user' => $user,
            'status_code' => $this->getStatusCode()

        ], [], $returnType);
        
    }


    /**
     * return message of not authorized 
     * @param type|null $user 
     * @param type|string $returnType 
     * @return JSON
     */
    public function respondWithNotAuthorized($message = 'Not authorized', $returnType = 'json') {

        $this->setStatusCode(ResponseCodes::HTTP_UNAUTHORIZED);

        return $this->respond([

            'error' => $message,
            'status_code' => $this->getStatusCode()

        ], [], $returnType);
        
    }


}
