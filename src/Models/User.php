<?php

declare(strict_types=1);

namespace Rackforest\Models;

class User
{
    public function __construct(
        public private(set) int $id,
        public private(set) string $email,
        public private(set) bool $isActive,
        public private(set) string $createdAt,
        public private(set) string $deletedAt,
    ) {}

    /**
     * @param array $attributes Array containing user data with keys:
     *     - id
     *     - email
     *     - is_active
     *     - created_at
     *     - deleted_at
     */
    public static function fromArray(array $attributes): self
    {
        return new User(
            $attributes['id'],
            $attributes['email'],
            (bool) $attributes['is_active'],
            $attributes['created_at'] ?? '',
            $attributes['deleted_at'] ?? '',
        );
    }
}
