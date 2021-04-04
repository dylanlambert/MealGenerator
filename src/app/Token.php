<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Token
 *
 * @property string $token
 * @property string $id
 * @property string $start_validity_date
 * @method static \Illuminate\Database\Eloquent\Builder|Token newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Token newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Token query()
 * @method static \Illuminate\Database\Eloquent\Builder|Token whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Token whereStartValidityDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Token whereToken($value)
 * @mixin \Eloquent
 */
final class Token extends Model
{
    use HasUuidPrimeryKey;

    /**
     * @var bool
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     */
    public $timestamps = false;

    /**
     * @inheritdoc
     */
    protected $primaryKey = 'token';
}
