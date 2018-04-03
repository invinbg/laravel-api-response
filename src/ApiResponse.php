<?php
namespace InviNBG;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Response as FoundationResponse;

class ApiResponse
{
    /**
     * @var int
     */
    protected $statusCode = FoundationResponse::HTTP_OK;
    protected $data = [];

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
        if (class_exists($transformers) && $this->data instanceof Model) {
            $this->data = call_user_func([$transformers, 'transform'], $this->data);
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
    public function response($message = '',$code = '',array $data = []){
        if (empty($message)){
            $message = ($code ?: $this->statusCode) === 200 ? '请求成功': '请求失败';
        }
        return response([
            'code'=>$code ?: $this->statusCode,
            'data'=> $data ?: $this->data,
            'message'=>$message,
        ],$this->statusCode);
    }
}