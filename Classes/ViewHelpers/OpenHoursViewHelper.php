<?php

namespace Tp3\Tp3Openhours\ViewHelpers;

/**
 * This file is part of the "tt_address" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use Tp3\Tp3Openhours\Domain\Model\OpenHour;
use Tp3\Tp3Openhours\Domain\Model\TtAddress;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Context\Exception\AspectNotFoundException;
use TYPO3\CMS\Core\Context\LanguageAspect;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;

class OpenHoursViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /* @var $dataMapper \TYPO3\CMS\Extbase\Persistence\Generic\Mapper\DataMapper */
    protected $dataMapper;

    /**
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * Inject the DataMapper
     *
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\Mapper\DataMapper $dataMapper
     */
    public function injectDataMapper(\TYPO3\CMS\Extbase\Persistence\Generic\Mapper\DataMapper $dataMapper): void
    {
        $this->dataMapper = $dataMapper;
    }

    /**
     * Initialize arguments
     */
    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('addresses', 'mixed', 'Addresses', true);
        $this->registerArgument('parameters', 'array', 'Parameters', true);
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return string
     */
    public function render(): array|string
    {
        return  $this->mapResultToObjects( $this->arguments['addresses']);
    }
    /**
     * Map the array from DB to an understandable output
     *
     * @param array $result
     * @return array
     */
    protected function mapResultToObjects( $result): array
    {
        $out = [];
       if(is_array($result)){
           foreach ($result as $_id => $single) {
               if($single->getUid() > 0 && !in_array($single->getUid(),$out)){
                   $out[$_id] = $this->getObject($single->getUid());
               }
           }
       }else if(is_int($result)){
           $out = $this->getObject($result);

       } else  if(!empty($result)){
           $out = $this->getObject($result->getUid());

       }

        return $out;
    }

    /**
     * Get the news object from the given id
     *
     * @param int $id
     * @return mixed|null
     * @throws AspectNotFoundException
     */
    protected function getObject($id): mixed
    {
        $record = [];
        unset($rawRecords);
        $rawRecords = $this->getRawRecord($id);
        while($rawRecord = $rawRecords->fetchAssociative()){

                /** @var LanguageAspect $languageAspect */
                $languageAspect = GeneralUtility::makeInstance(Context::class)->getAspect('language');

                if (isset($GLOBALS['TSFE']) && is_object($GLOBALS['TSFE']) && $languageAspect->getContentId() > 0) {
                    $overlay = $GLOBALS['TSFE']->sys_page->getRecordOverlay(
                        'tx_tp3openhours_domain_model_openhour',
                        $rawRecord,
                        $languageAspect->getContentId(),
                        $languageAspect->getLegacyOverlayType()
                    );
                    if (!is_null($overlay)) {
                        $rawRecord = $overlay;
                    }
                }
                if (is_array($rawRecord)) {
                    $records = $this->dataMapper->map(OpenHour::class, [$rawRecord]);
                 $record[] = array_shift($records);
                }
        }
        return $record;
    }


    /**
     * @return QueryBuilder
     */
    protected function getQueryBuilder(): QueryBuilder
    {
        return GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_tp3openhours_domain_model_openhour');
    }

    /**
     * @param $id
     * @return \TYPO3\CMS\Core\Database\QueryResult
     */
    protected function getRawRecord($id)
    {
        $queryBuilder = $this->getQueryBuilder();
        if(!is_int($id)){
            return [];
        }
        $rawRecord = $queryBuilder
            ->select('*')
            ->from('tx_tp3openhours_domain_model_openhour')
            ->where(
                $queryBuilder->expr()->eq('ttaddress', $queryBuilder->createNamedParameter($id, \TYPO3\CMS\Core\Database\Connection::PARAM_INT))
            )
            ->executeQuery();
        return $rawRecord;
    }
}
