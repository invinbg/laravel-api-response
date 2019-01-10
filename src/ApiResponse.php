<?php
namespace InviNBG\ApiResponse;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response as FoundationResponse;

class ApiResponse
{
    /**
     * @var int
     */
    protected $code;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $data;

    protected $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
        $this->data = new Collection();
    }

    public static function __callStatic($method, $parameters)
    {
        if ($method === 'response' || $method === 'getInstance') {
            $self = new self(new Response());
            return $self->getInstance(...$parameters);
        }

        throw new ApiReponseException(sprintf(
            'Method %s::%s does not exist.', static::class, $method
        ));
    }

    /**
     * 获取实例
     * @return $this
     */
    protected function getInstance()
    {
        return $this;
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
        return $this->code;
    }

    /**
     * @param $code
     * @return $this
     */
    public function withCode($code)
    {

        $this->code = $code;
        return $this;
    }

    /**
     * 获取Response的数据
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * 设置Response的数据
     * @param $data
     * @return $this
     */
    public function withData($data, $override = false)
    {
        if ($data instanceof Arrayable) {
            $data = $data->toArray();
        }
        foreach ((array)$data as $key=>$value) {
            if (is_numeric($key)) {
                if ($this->data->has($key) && $override) {
                    $this->data->push($value);
                } else {
                    $this->data->put($key, $value);
                }
            } else {
                $this->data->put($key, $value);
            }
        }

        return $this;
    }

    /**
     * 成功返回
     * @param string $message
     * @return \Illuminate\Contracts\Routing\ResponseFactory|FoundationResponse
     */
    public function success($message = '请求成功')
    {
        return $this->send($message, $this->code ?? Response::HTTP_OK);
    }

    /**
     * 失败返回
     * @param string $message
     * @return \Illuminate\Contracts\Routing\ResponseFactory|FoundationResponse
     */
    public function error($message = '请求失败')
    {
        return $this->send($message, $this->code ?? Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * 返回
     * @param string $message
     * @param string $code
     * @param array $data
     * @return \Illuminate\Contracts\Routing\ResponseFactory|FoundationResponse
     */
    public function send($message = '', $code = null, $data = [])
    {
        $data && $this->withData($data);
        $code && $this->withCode($code);

        return $this->response->setContent([
            'code' => $this->code,
            'data' => $this->data->isEmpty() ? null : $this->data,
            'message' => $message,
        ])->send();
    }
}