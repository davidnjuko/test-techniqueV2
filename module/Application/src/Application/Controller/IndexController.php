<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $em = $this->getServiceLocator()->get('entity_manager');
        $em->getRepository('Application\Entity\User');

        $users = $em->getRepository('Application\Entity\User')->findAll();
        /** @var \Application\Service\UserService $serviceUser */
        $serviceUser = $this->getServiceLocator()->get('application.service.user');

        /** @var \Elastica\Client $elasticSearchClient */
        return new ViewModel();
    }

    public function createIndexAction()
    {
        $elasticaClient = $this->getServiceLocator()->get('elastic.client');
        $elasticaIndex = $elasticaClient->getIndex('test-technique-users');
        $elasticaIndex->create(
            array(
                'number_of_shards'   => 6,
                'number_of_replicas' => 1,
                'analysis'           => array(
                    'analyzer' => array(
                        'indexAnalyzer'  => array(
                            'type'      => 'custom',
                            'tokenizer' => 'standard',
                            'filter'    => array('lowercase', 'mySnowball')
                        ),
                        'searchAnalyzer' => array(
                            'type'      => 'custom',
                            'tokenizer' => 'standard',
                            'filter'    => array('standard', 'lowercase', 'mySnowball')
                        )
                    ),
                    'filter'   => array(
                        'mySnowball' => array(
                            'type'     => 'snowball',
                            'language' => 'French'
                        )
                    )
                )
            ),
            true
        );

        $elasticaType = $elasticaIndex->getType('user');
        $mapping      = new \Elastica\Type\Mapping();
        $mapping->setType($elasticaType);
        $mapping->setParam('index_analyzer', 'indexAnalyzer');
        $mapping->setParam('search_analyzer', 'searchAnalyzer');
        // Define boost field
        $mapping->setParam('_boost', array('name' => '_boost', 'null_value' => 1.0));
        $mapping->setProperties(
            array(
                'id'              => array('type' => 'integer', 'include_in_all' => false)
            )
        );

        $mapping->send();

        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        return $viewModel;
    }
}
