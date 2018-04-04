<?php
namespace InviNBG\ApiReponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response as FoundationResponse;

class ApiResponse
{
    /**
     * @var int
     */
    protected $statusCode = FoundationResponse::HTTP_OK;
    protected $data = [];

    protected $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public static function __callStatic($method, $parameters)
    {
        if ($method === 'response') {
            $self = new self(new Response());
            return $self->response(...$parameters);
        }

        throw new ApiReponseException(sprintf(
            'Method %s::%s does not exist.', static::class, $method
        ));
    }

    protected function response()
    {
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     * @return $this
     */
    public function withCode($statusCode)
    {

        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * 获取Response的数据
     * @return array
     */
    public function getData(){
        return $this->data;
    }

    /**
     * 设置Response的数据
     * @param $data
     * @return $this
     */
    public function withData($data){
        $this->data = $data;
        return $this;
    }

    /**
     * 自定义字段映射
     * @param $transformers
     * @return $this
     */
    public function transformers($transformers)
    {
        try {
            if (class_exists($transformers)) {
                if ($this->data instanceof AbstractPaginator) {
                    $this->data->setCollection(collect(call_user_func([$transformers, 'transform'], $this->data->getCollection())));
                } elseif ($this->data instanceof Model || $this->data instanceof Collection) {
                    $this->data = call_user_func([$transformers, 'transform'], $this->data);
                }
            }
        } catch(\Exception $e) {
            throw new ApiReponseException($e->getMessage());
        }

        return $this;
    }

    /**
     * 返回
     * @param string $message
     * @param string $code
     * @param array $data
     * @return \Illuminate\Contracts\Routing\ResponseFactory|FoundationResponse
     */
    public function send($message = '',$code = '',array $data = []){
        if (empty($message)){
            $message = ($code ?: $this->statusCode) === 200 ? '请求成功': '请求失败';
        }
        return $this->response->setStatusCode($code ?: $this->statusCode)->setContent([
            'code'=>$code ?: $this->statusCode,
            'data'=> $data ?: $this->data,
            'message'=>$message,
        ])->send();
    }
}