<?php

class __Mustache_669fcfad065cfdb84aee8929207ad4a9 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $value = $context->find('ltnote');
        $buffer .= $this->section463073a46602299f6c7413d5fd97c0ec($context, $indent, $value);

        return $buffer;
    }

    private function section73b719f0610bc7d7f0ddff0054922b20(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'ticked';
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
                
                $buffer .= 'ticked';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section463073a46602299f6c7413d5fd97c0ec(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <div class="ltnoteinfo" id="ltnoteinfo">
        <button type="submit" id="ltnote-action" data-hovercolor="{{iconbackcolor}}"
        data-fontcolor="{{iconcolor}}" style="background:{{iconbackcolor}};">
            <i class="{{icon}}" style="color:{{iconcolor}}"></i>
                <span  class="{{#pagenotes}}ticked{{/pagenotes}}"> {{pagenotes}} </span>
        </button>
        <p> {{notehovername}} </p>
    </div>
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
                
                $buffer .= $indent . '    <div class="ltnoteinfo" id="ltnoteinfo">
';
                $buffer .= $indent . '        <button type="submit" id="ltnote-action" data-hovercolor="';
                $value = $this->resolveValue($context->find('iconbackcolor'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '"
';
                $buffer .= $indent . '        data-fontcolor="';
                $value = $this->resolveValue($context->find('iconcolor'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" style="background:';
                $value = $this->resolveValue($context->find('iconbackcolor'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= ';">
';
                $buffer .= $indent . '            <i class="';
                $value = $this->resolveValue($context->find('icon'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" style="color:';
                $value = $this->resolveValue($context->find('iconcolor'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '"></i>
';
                $buffer .= $indent . '                <span  class="';
                $value = $context->find('pagenotes');
                $buffer .= $this->section73b719f0610bc7d7f0ddff0054922b20($context, $indent, $value);
                $buffer .= '"> ';
                $value = $this->resolveValue($context->find('pagenotes'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= ' </span>
';
                $buffer .= $indent . '        </button>
';
                $buffer .= $indent . '        <p> ';
                $value = $this->resolveValue($context->find('notehovername'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= ' </p>
';
                $buffer .= $indent . '    </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
