<?php
/**
 * Created by PhpStorm.
 * User: ars
 * Date: 04.10.18
 * Time: 0:16
 */

namespace Controller;

class BaseController {

    /**
     * @param string[] $data
     * @return string
     */
    protected function _jsonSuccessResponse(array $data = []) {
        return $this->_jsonIsSuccess(true, [], $data);
    }

    /**
     * @param string[] $errors
     * @return string
     */
    protected function _jsonFailResponse(array $errors = []) {
        return $this->_jsonIsSuccess(false, $errors);
    }

    /**
     * @param bool $isSuccess
     * @param string[] $errors
     * @param string[] $data
     * @return string
     */
    private function _jsonIsSuccess($isSuccess, array $errors = [], array $data = []) {
        return $this->_jsonResponse(['success' => $isSuccess, 'error' => $errors, 'data' => $data]);
    }

    /**
     * @param array $response
     * @return string
     */
    private function _jsonResponse(array $response) {
        $result = json_encode($response, JSON_UNESCAPED_UNICODE);
        header("Content-Type: application/json; charset=utf-8");
        return $result;
    }
}