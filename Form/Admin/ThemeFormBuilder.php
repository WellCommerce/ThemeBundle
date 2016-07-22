<?php
/*
 * WellCommerce Open-Source E-Commerce Platform
 *
 * This file is part of the WellCommerce package.
 *
 * (c) Adam Piotrowski <adam@wellcommerce.org>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */
namespace WellCommerce\Bundle\ThemeBundle\Form\Admin;

use WellCommerce\Bundle\CoreBundle\Form\AbstractFormBuilder;
use WellCommerce\Component\Form\Elements\FormInterface;

/**
 * Class ThemeFormBuilder
 *
 * @author Adam Piotrowski <adam@wellcommerce.org>
 */
class ThemeFormBuilder extends AbstractFormBuilder
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormInterface $form)
    {
        $themeFolders = $this->get('theme.locator')->getThemeFolders();
        
        $requiredData = $form->addChild($this->getElement('nested_fieldset', [
            'name'  => 'required_data',
            'label' => $this->trans('common.fieldset.general')
        ]));
        
        $requiredData->addChild($this->getElement('text_field', [
            'name'  => 'name',
            'label' => $this->trans('common.label.name'),
            'rules' => [
                $this->getRule('required')
            ],
        ]));
        
        $requiredData->addChild($this->getElement('select', [
            'name'    => 'folder',
            'label'   => $this->trans('theme.label.folder'),
            'comment' => $this->trans('theme.comment.folder'),
            'options' => $themeFolders,
            'default' => reset($themeFolders)
        ]));
        
        $form->addFilter($this->getFilter('no_code'));
        $form->addFilter($this->getFilter('trim'));
        $form->addFilter($this->getFilter('secure'));
    }
}
