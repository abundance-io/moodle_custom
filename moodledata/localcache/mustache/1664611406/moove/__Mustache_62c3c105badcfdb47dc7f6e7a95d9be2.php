<?php

class __Mustache_62c3c105badcfdb47dc7f6e7a95d9be2 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '
';
        $buffer .= $indent . '<div class="card-deck dashboard-card-deck ';
        $blockFunction = $context->findInBlock('classes');
        if (is_callable($blockFunction)) {
            $buffer .= call_user_func($blockFunction, $context);
        }
        $buffer .= '" data-region="card-deck" role="list">
';
        $value = $context->find('courses');
        $buffer .= $this->section5c6d7799b9df0a38f5821b3a1e2b443d($context, $indent, $value);
        $buffer .= $indent . '</div>
';

        return $buffer;
    }

    private function section5c6d7799b9df0a38f5821b3a1e2b443d(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    {{> core_course/coursecard }}
';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            if (strpos($result, '{{') === false) {
                $buffer .= $result;
            } else {
                $buffer .= $this->mustache
                    ->loadLambda($result)
                    ->renderInternal($context);
            }
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                if ($partial = $this->mustache->loadPartial('core_course/coursecard')) {
                    $buffer .= $partial->renderInternal($context, $indent . '    ');
                }
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
