<?php

class __Mustache_6689e494622d0534ef668c821bd5f0c0 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        if ($parent = $this->mustache->loadPartial('core_form/element-template')) {
            $context->pushBlockContext(array(
                'element' => array($this, 'block3fba638509d5e87b3643585c1708aeba'),
            ));
            $buffer .= $parent->renderInternal($context, $indent);
            $context->popBlockContext();
        }

        return $buffer;
    }


    public function block3fba638509d5e87b3643585c1708aeba($context)
    {
        $indent = $buffer = '';
        $buffer .= $indent . '        <div class="form-control-static">
';
        $buffer .= $indent . '        ';
        $value = $this->resolveValue($context->findDot('element.html'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= '
';
        $buffer .= $indent . '        </div>
';
    
        return $buffer;
    }
}
