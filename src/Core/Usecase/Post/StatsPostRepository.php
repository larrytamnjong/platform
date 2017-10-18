<?php

/**
 * Ushahidi Platform Stats Post Repository
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Platform
 * @copyright  2014 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

namespace Ushahidi\Core\Usecase\Post;

use Ushahidi\Core\SearchData;

interface StatsPostRepository
{

	/**
	 * Get Column Names for given Post Data
	 * @param  Post Data array $data
	 * @return Array
	 */
	public function retrieveColumnNameData($data);
}
