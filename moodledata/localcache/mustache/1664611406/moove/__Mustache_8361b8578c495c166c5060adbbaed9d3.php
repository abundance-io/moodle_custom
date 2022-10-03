<?php

class __Mustache_8361b8578c495c166c5060adbbaed9d3 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '
';
        $value = $context->find('ltbookmark');
        $buffer .= $this->sectionC17990b5c55056ed9777f61caf850c9b($context, $indent, $value);

        return $buffer;
    }

    private function sectionC17990b5c55056ed9777f61caf850c9b(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
<div class="ltbookmarksinfo" id="ltbookmarksinfo" data-tool="bookmarks">
    <button type="submit" id="ltbookmarks-action" data-hovercolor="{{iconbackcolor}}"
    data-fontcolor="{{iconcolor}}" style="background:{{iconbackcolor}};">
        <i class="{{icon}}" id="bookmarks-marked" style="color:{{iconcolor}}"></i>
        <span class="fa fa-check"></span>
    </button>
    <p> {{bookmarkhovername}} </p>
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
                
                $buffer .= $indent . '<div class="ltbookmarksinfo" id="ltbookmarksinfo" data-tool="bookmarks">
';
                $buffer .= $indent . '    <button type="submit" id="ltbookmarks-action" data-hovercolor="';
                $value = $this->resolveValue($context->find('iconbackcolor'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '"
';
                $buffer .= $indent . '    data-fontcolor="';
                $value = $this->resolveValue($context->find('iconcolor'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" style="background:';
                $value = $this->resolveValue($context->find('iconbackcolor'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= ';">
';
                $buffer .= $indent . '        <i class="';
                $value = $this->resolveValue($context->find('icon'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" id="bookmarks-marked" style="color:';
                $value = $this->resolveValue($context->find('iconcolor'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '"></i>
';
                $buffer .= $indent . '        <span class="fa fa-check"></span>
';
                $buffer .= $indent . '    </button>
';
                $buffer .= $indent . '    <p> ';
                $value = $this->resolveValue($context->find('bookmarkhovername'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= ' </p>
';
                $buffer .= $indent . '</div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
