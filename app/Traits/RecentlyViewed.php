<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Session;

trait RecentlyViewed
{
    /**
     * Get recently viewed items.
     *
     * @param int $limit The maximum number of items to retrieve.
     * @return Collection
     */
    public static function getRecentlyViewed(int $limit = 5): Collection
    {
        $table = self::getTableName();
        $recentlyViewed = Session::get("$table.recently_viewed", []);
        if (empty($recentlyViewed)) {
            return new Collection();
        }

        return self::whereIn('id', $recentlyViewed)
            ->limit($limit)
            ->get()
            ->sortBy(function ($product) use ($recentlyViewed) {
                return array_search($product->id, $recentlyViewed);
            });
    }

    /**
     * Add an item to the recently viewed list.
     *
     * @return void
     */
    public function addRecentlyViewed(): void
    {
        $table = $this->getTable();
        $recentlyViewed = Session::get("$table.recently_viewed", []);

        if (!in_array($this->id, $recentlyViewed)) {
            array_unshift($recentlyViewed, $this->id); // Add to the beginning of the array
        }

        Session::put("$table.recently_viewed", array_slice($recentlyViewed, 0, 10)); // Limit to 10 items
    }

    /**
     * Clear the recently viewed list.
     *
     * @return void
     */
    public static function clearRecentlyViewed(): void
    {
        $table = self::getTable();
        Session::forget("$table.recently_viewed");
    }

    /**
     * Get the table name.
     *
     * @return string
     */
    public static function getTableName(): string
    {
        return with(new static)->getTable();
    }
}
