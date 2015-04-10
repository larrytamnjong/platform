<?php

/**
 * Ushahidi Post
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Platform
 * @copyright  2014 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

namespace Ushahidi\Core\Entity;

use Ushahidi\Core\StaticEntity;

class Post extends StaticEntity
{
	protected $id;
	protected $parent_id;
	protected $form_id;
	protected $user_id;
	protected $type;
	protected $title;
	protected $slug;
	protected $content;
	protected $author_email;
	protected $author_realname;
	protected $status;
	protected $created;
	protected $updated;
	protected $locale;
	protected $values;
	protected $tags;
	protected $published_to;

	// StatefulData
	protected function getDerived()
	{
		return [
			'slug'    => function ($data) {
				if (array_key_exists('title', $data)) {
					return $data['title'] . ' ' . uniqid();
				}
				return false;
			},
			'form_id'   => ['form', 'form.id'], /* alias */
			'user_id'   => ['user', 'user.id'], /* alias */
			'parent_id' => ['parent', 'parent.id'], /* alias */
		];
	}

	// DataTransformer
	protected function getDefinition()
	{
		return [
			'id'              => 'int',
			'parent_id'       => 'int',
			'form'            => false, /* alias */
			'form_id'         => 'int',
			'user'            => false, /* alias */
			'user_id'         => 'int',
			'type'            => 'string',
			'title'           => 'string',
			'slug'            => '*slug',
			'content'         => 'string',
			'author_email'    => 'string', /* @todo email filter */
			'author_realname' => 'string', /* @todo redundent with user record */
			'status'          => 'string',
			'created'         => 'int',
			'updated'         => 'int',
			'locale'          => '*lowercasestring',
			'values'          => 'array',
			'tags'            => 'array',
			'published_to'	=> '*json',
		];
	}

	// Entity
	public function getResource()
	{
		return 'posts';
	}

	// StatefulData
	protected function getImmutable()
	{
		return ['id', 'type', 'form_id'];
	}
}
