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
    protected $code = Response::HTTP_OK;

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
    public function success($message = '操作成功')
    {
        return $this->send($message, $this->code, $this->data, true);
    }

    /**
     * 失败返回
     * @param string $message
     * @return \Illuminate\Contracts\Routing\ResponseFactory|FoundationResponse
     */
    public function error($message = '操作失败')
    {
        return $this->send($message, $this->code, $this->data, false);
    }

    /**
     * 返回
     * @param string $message
     * @param string $code
     * @param array $data
     * @return \Illuminate\Contracts\Routing\ResponseFactory|FoundationResponse
     */
    public function send($message = '', $code = null, $data = [], bool $success = true)
    {
        return $this->response->setContent([
            'succ' => $success,
            'code' => $code ?? $this->code,
            'data' => $data ?: $this->data,
            'msg' => $message,
        ])->send();
    }
}