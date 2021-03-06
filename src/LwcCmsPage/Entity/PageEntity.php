<?php
namespace LwcCmsPage\Entity;

use Zend\View\Helper\HeadScript;
use Zend\View\Helper\HeadLink;
use Zend\View\Helper\InlineScript;
use Zend\Stdlib\ArraySerializableInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

class PageEntity implements ArraySerializableInterface, PageEntityInterface
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var integer
     */
    protected $depth;

    /**
     *
     * @var string
     */
    protected $layout;

    /**
     *
     * @var string
     */
    protected $identifier;

    /**
     *
     * @var integer
     */
    protected $lft;

    /**
     *
     * @var integer
     */
    protected $rgt;

    /**
     *
     * @var boolean
     */
    protected $isVisible = false;

    /**
     *
     * @var \DateTime
     */
    protected $visibilityStart;

    /**
     *
     * @var \DateTime
     */
    protected $visibilityEnd;

    /**
     *
     * @var string
     */
    protected $title;

    /**
     *
     * @var string
     */
    protected $subtitle;

    /**
     *
     * @var string
     */
    protected $summary;

    /**
     *
     * @var HeadScript
     */
    protected $headScript;

    /**
     *
     * @var HeadLink
     */
    protected $headLink;

    /**
     *
     * @var InlineScript
     */
    protected $inlineScript;

    /**
     *
     * @var string
     */
    protected $changefreq = 'monthly';

    /**
     *
     * @var float
     */
    protected $priority = 0.5;

    /**
     *
     * @var array
     */
    protected $rows = array();

    /**
     * (non-PHPdoc)
     *
     * @see \LwcCmsPage\Entity\PageEntityInterface::getId()
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \LwcCmsPage\Entity\PageEntityInterface::getIdentifier()
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \LwcCmsPage\Entity\PageEntityInterface::setIdentifier()
     */
    public function setIdentifier($identifier)
    {
        if(trim($identifier) === '') {
            $identifier = null;
        }
        $this->identifier = $identifier;
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\Stdlib\ArraySerializableInterface::exchangeArray()
     */
    public function exchangeArray(array $array)
    {
        $hydrator = new ClassMethods();
        $hydrator->hydrate($array, $this);
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\Stdlib\ArraySerializableInterface::getArrayCopy()
     */
    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'lft' => $this->getLft(),
            'rgt' => $this->getRgt(),
            'isVisible' => $this->getIsVisible(),
            'visibilityStart' => $this->getVisibilityStart(),
            'visibilityEnd' => $this->getVisibilityEnd(),
            'layout' => $this->getLayout(),
            'identifier' => $this->getIdentifier(),
            'title' => $this->getTitle(),
            'subtitle' => $this->getSubtitle(),
            'summary' => $this->getSummary(),
            'changefreq' => $this->getChangefreq(),
            'priority' => $this->getPriority()
        );
    }

    /**
     * (non-PHPdoc)
     *
     * @see \LwcCmsPage\Entity\PageEntityInterface::getLayout()
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \LwcCmsPage\Entity\PageEntityInterface::setLayout()
     */
    public function setLayout($layout)
    {
        $this->layout = trim($layout);
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \LwcCmsPage\Entity\PageEntityInterface::getLft()
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \LwcCmsPage\Entity\PageEntityInterface::getRgt()
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \LwcCmsPage\Entity\PageEntityInterface::getIsVisible()
     */
    public function getIsVisible()
    {
        if (! $this->isVisible) {
            return false;
        }
        $start = $this->getVisibilityStart();
        $end = $this->getVisibilityEnd();
        $now = new \DateTime();
        
        if (($start !== null && $start > $now) || ($end !== null && $end < $now)) {
            return false;
        }
        return true;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \LwcCmsPage\Entity\PageEntityInterface::getTitle()
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     *
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \LwcCmsPage\Entity\PageEntityInterface::getSummary()
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \LwcCmsPage\Entity\PageEntityInterface::getContentRows()
     */
    public function getContentRows()
    {
        return $this->rows;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \LwcCmsPage\Entity\PageEntityInterface::setContentRows()
     */
    public function setContentRows(array $rows)
    {
        $this->rows = array();
        foreach ($rows as $row) {
            $this->addContentRow($row);
        }
        return $this;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \LwcCmsPage\Entity\PageEntityInterface::addContentRow()
     */
    public function addContentRow(RowEntityInterface $row)
    {
        $this->rows[] = $row;
        return $this;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \LwcCmsPage\Entity\PageEntityInterface::setId()
     */
    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \LwcCmsPage\Entity\PageEntityInterface::setRgt()
     */
    public function setRgt($rgt)
    {
        $this->rgt = (int) $rgt;
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \LwcCmsPage\Entity\PageEntityInterface::setLft()
     */
    public function setLft($lft)
    {
        $this->lft = (int) $lft;
        return $this;
    }

    /**
     *
     * @param boolean $isVisible            
     * @return \LwcCmsPage\Entity\PageEntity
     */
    public function setIsVisible($isVisible)
    {
        $this->isVisible = (boolean) $isVisible;
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \LwcCmsPage\Entity\PageEntityInterface::setTitle()
     */
    public function setTitle($title)
    {
        $this->title = (string) $title;
        return $this;
    }

    /**
     *
     * @param string $subtitle            
     * @return \LwcCmsPage\Entity\PageEntity
     */
    public function setSubtitle($subtitle = null)
    {
        $this->subtitle = $subtitle;
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \LwcCmsPage\Entity\PageEntityInterface::setSummary()
     */
    public function setSummary($summary = null)
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     *
     * @return \Zend\View\Helper\HeadScript
     */
    public function getHeadScript()
    {
        if ($this->headScript == null) {
            $this->setHeadScript(new HeadScript());
        }
        return $this->headScript;
    }

    /**
     *
     * @param HeadScript $helper            
     * @return \LwcCmsPage\Entity\PageEntity
     */
    public function setHeadScript(HeadScript $helper)
    {
        $this->headScript = $helper;
        return $this;
    }

    /**
     *
     * @return \Zend\View\Helper\HeadLink
     */
    public function getHeadLink()
    {
        if ($this->headLink == null) {
            $this->setHeadLink(new HeadLink());
        }
        return $this->headLink;
    }

    /**
     *
     * @param HeadLink $helper            
     * @return \LwcCmsPage\Entity\PageEntity
     */
    public function setHeadLink(HeadLink $helper)
    {
        $this->headLink = $helper;
        return $this;
    }

    /**
     *
     * @return \Zend\View\Helper\InlineScript
     */
    public function getInlineScript()
    {
        if ($this->inlineScript == null) {
            $this->inlineScript = new InlineScript();
        }
        return $this->inlineScript;
    }

    /**
     *
     * @param InlineScript $inlineScript            
     * @return \LwcCmsPage\Entity\PageEntity
     */
    public function setInlineScript(InlineScript $inlineScript)
    {
        $this->inlineScript = $inlineScript;
        return $this;
    }

    /**
     *
     * @return \DateTime
     *         $visibilityStart
     */
    public function getVisibilityStart()
    {
        return $this->visibilityStart;
    }

    /**
     *
     * @return \DateTime
     *         $visibilityEnd
     */
    public function getVisibilityEnd()
    {
        return $this->visibilityEnd;
    }

    /**
     *
     * @param string|\DateTime $visibilityStart            
     * @return \LwcCmsPage\Entity\PageEntity
     */
    public function setVisibilityStart($visibilityStart)
    {
        if ($visibilityStart && ! $visibilityStart instanceof \DateTime) {
            $visibilityStart = new \DateTime($visibilityStart);
        }
        $this->visibilityStart = $visibilityStart;
        return $this;
    }

    /**
     *
     * @param string|\DateTime $visibilityEnd            
     * @return \LwcCmsPage\Entity\PageEntity
     */
    public function setVisibilityEnd($visibilityEnd)
    {
        if ($visibilityEnd && ! $visibilityEnd instanceof \DateTime) {
            $visibilityEnd = new \DateTime($visibilityEnd);
        }
        $this->visibilityEnd = $visibilityEnd;
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \LwcCmsPage\Entity\PageEntityInterface::getDepth()
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \LwcCmsPage\Entity\PageEntityInterface::setDepth()
     */
    public function setDepth($depth)
    {
        $this->depth = (int) $depth;
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \LwcCmsPage\Entity\PageEntityInterface::getChangefreq()
     */
    public function getChangefreq()
    {
        return $this->changefreq;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \LwcCmsPage\Entity\PageEntityInterface::setChangefreq()
     */
    public function setChangefreq($freq)
    {
        $this->changefreq = strtolower($freq);
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \LwcCmsPage\Entity\PageEntityInterface::getPriority()
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \LwcCmsPage\Entity\PageEntityInterface::setPriority()
     */
    public function setPriority($prio)
    {
        $this->priority = (float) $prio;
        return $this;
    }
}