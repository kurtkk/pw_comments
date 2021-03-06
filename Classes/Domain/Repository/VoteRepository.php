<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011-2014 Armin Ruediger Vieweg <armin@v.ieweg.de>
*
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * Repository for Tx_PwComments_Domain_Model_Vote
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_PwComments_Domain_Repository_VoteRepository extends Tx_Extbase_Persistence_Repository {
	/**
	 * Initializes the repository.
	 *
	 * @return void
	 * @see Tx_Extbase_Persistence_Repository::initializeObject()
	 */
	public function initializeObject() {
		$querySettings = $this->objectManager->create('Tx_Extbase_Persistence_Typo3QuerySettings');
		$querySettings->setRespectStoragePage(FALSE);
		$this->setDefaultQuerySettings($querySettings);
	}

	/**
	 * Find votes by pid
	 *
	 * @param integer $pid pid to get comments for
	 * @param string $authorIdent
	 * @return Tx_Extbase_Persistence_QueryResult found votes
	 */
	public function findByPidAndAuthorIdent($pid, $authorIdent) {
		$query = $this->createQuery();
		$query->matching(
			$query->logicalAnd(
				$query->equals('pid', $pid),
				$query->equals('authorIdent', $authorIdent)
			)
		);
		return $query->execute();
	}

	/**
	 * Find vote by given comment and authorIdent
	 *
	 * @param Tx_PwComments_Domain_Model_Comment $comment
	 * @param string $authorIdent
	 * @return Tx_PwComments_Domain_Model_Vote
	 */
	public function findOneByCommentAndAuthorIdent(Tx_PwComments_Domain_Model_Comment $comment, $authorIdent) {
		$query = $this->createQuery();
		$query->matching(
			$query->logicalAnd(
				$query->equals('comment', $comment),
				$query->equals('authorIdent', $authorIdent)
			)
		);
		return $query->execute()->getFirst();
	}
}