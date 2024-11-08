<?php

namespace EFive\Bale\Objects;

/**
 * Class StickerSet.
 *
 * @link https://docs.bale.ai/#stickerset
 *
 * @property string $name Sticker set name
 * @property string $title Sticker set title
 * @property Sticker[] $stickers List of all set stickers
 * @property PhotoSize|null $thumbnail (Optional). Sticker set thumbnail in the .WEBP or .TGS format
 */
class StickerSet extends BaseObject
{
    /**
     * {@inheritdoc}
     *
     * @return array{stickers: array<class-string<Sticker>>, thumbnail: string}
     */
    public function relations(): array
    {
        return [
            'stickers' => [Sticker::class],
            'thumbnail' => PhotoSize::class,
        ];
    }
}