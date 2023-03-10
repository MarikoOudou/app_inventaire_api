<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="ResponseData",
 *     description="",
 *     @OA\Xml(
 *         name="ResponseData"
 *     )
 * )
 */
class ResponseData
{

    /**
     * @OA\Property(
     *     title="code"
     * )
     *
     * @var integer
     */
    private $code;

    /**
     * @OA\Property(
     *     title="status"
     * )
     *
     * @var boolean
     */
    private $status;

    /**
     * @OA\Property(
     *     title="message"
     * )
     *
     * @var string
     */
    private $message;

    /**
     * @OA\Property(
     *     title="data"
     * )
     *
     * @var object
     */
    private $data;

}
