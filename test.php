<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="js/num-alignment.js"></script>
    <script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>
</head>
<body>
    <!-- 
        1.本插件基于jquery基础封装的轻量级插件，使用时只需导入num-alignment.js即可；
            必须手动初始化插件，初始化方法： alignmentFns.initialize();
            初始化之后需要js动态变化数据，需要先调用销毁方法alignmentFns.destroy();，数据变化完成之后再次调用初始化才可生效
        2.插件设置默认值：{"step" : 0.1, "min" : 0, "max" : 99, "digit" : 1}；
        3.可以自定义设置类型   ——》 通过调用 alignmentFns.createType()方法。
            例：alignmentFns.data.test = {"step" : 10, "min" : 10, "max" : 999, "digit" : 0}
        4.引用自定义类型通过  input框中设置  user_data属性；
        5.如果认为插件数据设置不够合理可通过 data-step，data-min，data-max，data-digit四个属性设置步长、最小值、最大值、小数位数；
             ☆：注意属性值将会覆盖类型值；
        6.插件默认设置readonly，如果你想设置为编辑，可通过属性 data-edit="true"设置；
        7.插件为自动装载，但是必须设置 user_data，data-step，data-min，data-max，data-digit，属性中的一个或者引用alignment css类；
        8.插件宽度通过计算所得，只能通过设置长度来调整，宽度设定将被忽略；
        9.一个页面多个插件时必须设置每个元素id
        作者信息：wagk（一个java小白） QQ：773279595     -->
    不可编辑:<input id="1" class="alignment" value="15.1"/><br><br>
    可编辑：<input id="2" class="alignment" data-edit="true" value="15.1"/><br><br>
    自定义类型：<input id="3" user_data="test" value="5"/><br><br>
    默认类型设置最大值：<input id="4" data-max="11" value="10"/><br><br>
    自定义数据：<input id="5" data-step="1" data-min="1" data-max="50" data-digit="0" value="1"/><br><br>
    设置长度:<input id="6" style="width:100px;" class="alignment" value="15.1"/>
    
    <script>

        // 自定义类型：参数为数组，可多条数据
        alignmentFns.createType([{"test": {"step" : 10, "min" : 10, "max" : 999, "digit" : 0}}]);
        
        // 初始化
        alignmentFns.initialize();
        
        // 销毁
        alignmentFns.destroy();
        
        // js动态改变数据
        $("#4").attr("data-max", "12")
        // 初始化
        alignmentFns.initialize();
        
    </script>
</body>
</html>