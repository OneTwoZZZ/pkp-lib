<?php

/**
 * @file classes/submission/SubmissionLanguageEntryDAO.inc.php
 *
 * Copyright (c) 2014-2019 Simon Fraser University
 * Copyright (c) 2000-2019 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class SubmissionLanguageEntryDAO
 * @ingroup submission
 * @see Submission
 *
 * @brief Operations for retrieving and modifying a submission's languages
 */

import('lib.pkp.classes.submission.SubmissionLanguage');
import('lib.pkp.classes.controlledVocab.ControlledVocabEntryDAO');

class SubmissionLanguageEntryDAO extends ControlledVocabEntryDAO {

	/**
	 * Construct a new data object corresponding to this DAO.
	 * @return submissionLanguage
	 */
	function newDataObject() {
		return new SubmissionLanguage();
	}

	/**
	 * Retrieve an iterator of controlled vocabulary entries matching a
	 * particular controlled vocabulary ID.
	 * @param $controlledVocabId int
	 * @param $filter null (Not yet supported)
	 * @return object DAOResultFactory containing matching CVE objects
	 */
	function getByControlledVocabId($controlledVocabId, $rangeInfo = null, $filter = null) {
		assert($filter == null); // Parent class supports this, but this class does not
		$result = $this->retrieveRange(
			'SELECT cve.* FROM controlled_vocab_entries cve WHERE cve.controlled_vocab_id = ? ORDER BY seq',
			array((int) $controlledVocabId),
			$rangeInfo
		);

		$returner = new DAOResultFactory($result, $this, '_fromRow');
		return $returner;
	}
}


