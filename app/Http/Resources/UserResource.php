<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      return [
        'id' => $this->id,
        'avatar' => $this->avatar,
        'name' => $this->name,
        'email' => $this->email,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
        'permissions' => $this->formatPermissions()
      ];
    }

  /**
   * @return array
   */
    private function formatPermissions(): array
    {
      $permissionsList = [];

      if ($permissions = $this->permissions) {
        foreach ($permissions as $permission) {
          $permissionsList[] = $permission->name;
        }
      }

      return $permissionsList;
    }
}
