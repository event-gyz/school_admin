    <style type="text/css" media="screen">
    .center {
        text-align: center;
    }
    
    .red {
        color: red;
    }
    
    .clearfix {
        overflow: hidden;
        zoom: 1;
    }
    
    .clearfix:before,
    .clearfix:after {
        display: table;
        content: " ";
    }
    
    .clearfix:after {
        clear: both;
    }
    
    #help.main {
        width: 100%;
        margin: 20px auto 0 ;
        min-width: 900px;
    }
    
    .main-l {
        margin-right: 200px;
        float: left;
    }
    
    .main-l h1 {
        color: #000;
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 20px;
    }
    
    .main-l h2 {
        color: #000;
        font-size: 18px;
        font-weight: bold;
        margin: 10px 0 10px 20px;
    }
    
    .main-l h3 {
        color: #000;
        font-size: 16px;
        font-weight: bold;
        margin: 10px 0 10px 20px;
    }
    
    .main-l ul {
        padding-left: 60px;
    }
    
    .main-l p {
        text-indent: 2rem;
    }
    
    .main-l table {
        margin-left: 20px;
        width: 700px;
        border-top: 1px solid #eee;
        border-left: 1px solid #eee;
    }
    
    .main-l table tr th {
        color: #333;
        font-weight: bold;
        text-align: left;
    }
    
    .main-l table tr td,
    .main-l table tr th {
        border-right: 1px solid #eee;
        border-bottom: 1px solid #eee;
        padding: 5px 10px;
    }
    
    .main-l img {
        width: 90%;
        margin: 10px 5%;
    }
    
    .main-r {
        position: fixed;
        top: 50px;
        right: 0;
        width: 190px;
        float: right;
    }
    
    .main-r ul {
        border: 1px solid #eee;
        padding: 0 10px;
    }
    
    .main-r ul li {
        padding: 5px 0;
    }
    
    .main-r ul li dl dt {
        font-size: 16px;
    }
    
    .main-r ul li dl dd a {
        display: block;
        color: #999;
        font-size: 14px;
        padding: 5px 0 5px 20px;
    }
    </style>
    <div class="main clearfix" id="help">
        <h1>AZ在线会议竞标系统操作手册</h1>
        <div class="main-l">
            <h1 id="a1">1、引言</h1>
            <h2 id="a2">1.1产品名称</h2>
            <p>名称：AZ在线会议竞标系统</p>
            <h2 id="a3">1.2产品版本</h2>
            <p>V1.0</p>
            <h1 id="a4">2、系统概述</h1>
            <h2 id="a5">2.1功能列表</h2>
            <table>
                <tr>
                    <th width="150">模块</th>
                    <th width="500">功能描述</th>
                </tr>
                <tr>
                    <td>创建会议</td>
                    <td>AZ用户根据会议需求Excel创建会议，复制历史会议信息。</td>
                </tr>
                <tr>
                    <td>会议管理</td>
                    <td>AZ用户可以查看会议、关闭会议、查看报价详情、导出酒店报价、对比报价、比对结果导出、会议议价、合并竞标、通知合并竞标、增加意向商家、邀请监管等操作。</td>
                </tr>
                <tr>
                    <td>用户管理</td>
                    <td>超级管理员可以创建不同角色用户。</td>
                </tr>
                <tr>
                    <td>中英文切换</td>
                    <td>AZ用户根据需要切换中文版和英文版本。</td>
                </tr>
            </table>
            <h1 id="a6">3、功能详细介绍</h1>
            <h2 id="a7">3.1系统登录</h2>
            <p>AZ用户在电脑中打开浏览器，在浏览器地址栏输入系统网址：<a href="http://novartis.eventown.com">http://novartis.eventown.com</a> 如下图所示：</p>
            <img src="../img/help/1.png" alt="">
            <p>AZ用户输入系统账号（企业邮箱）、密码(初始密码为123456，登录后可自行修改)、验证码点击“登录”按钮，进入AZ在线会议竞标系统。操作界面如下图所示：</p>
            <img src="../img/help/2.png" alt="">
            <p>菜单导航区：AZ用户可以在系统［菜单导航区］切换会议管理和用户管理。</p>
            <p>会议筛选区：AZ用户可以通过筛选条件进行筛选会议，形成列表。</p>
            <p>会议列表区：AZ用户可以查看会议详情，关闭会议等操作；</p>
            <h2 id="a8">3.2创建会议</h2>
            <h3 id="a9">3.2.1功能描述</h3>
            <p>AZ用户在［会议管理］模块可以创建一个会议，并把会议需求发给目标酒店（意向商家）。步骤如下：</p>
            <p>第一步：填写会议信息并上传需求Excel文件；</p>
            <p>第二步：根据会议需求挑选会议酒店，并把选择的目标酒店加入询单车；</p>
            <p>第三步：把会议需求发送给目标酒店。</p>
            <h3 id="a10">3.2.2操作流程</h3>
            <p>AZ用户可以在［会议管理］点击“创建会议”按钮创建一个会议，如下图所示：</p>
            <img src="../img/help/3.png" alt="">
            <h3>3.2.2.1填写基本信息/上传会议需求</h3>
            <p>AZ用户可以根据举办会议的实际要求在此页面填写基本信息包括：会议类型、竞标类型、竞标开始时间、竞标结束时间、子公司、备注信息、上传会议需求Excel和选择会议酒店<span class="red">(以上信息为必填项，如内容缺失则不能进行下一步)</span>。页面如下图所示</p>
            <img src="../img/help/4.png" alt="">
            <p>必填信息详解：</p>
            <p>1、会议类型</p>
            <p>会议类型包括：外部会议、内部会议、大会三种。</p>
            <p>2、竞标类型</p>
            <p>竞标类型包括：RFQ和auction两种；</p>
            <p>3、竞标时间</p>
            <p>竞标时间包括：竞标开始时间、竞标结束时间。</p>
            <p>4、选择子公司</p>
            <p>选择会议所属子公司名称。</p>
            <p>5、上传会议需求</p>
            <p>上传对应的会议需求Excel文件；</p>
            <p class="red">注意:会议类型与会议需求Excel对应的模板，以免上传失败。</p>
            <p class="red">常见错误提示：“会议需求不能被识别或内容有误”，请检查会议类型与Excel模板是否一致（详见下图）:</p>
            <img src="../img/help/5.png" alt="">
            <p>6、选择会议酒店</p>
            <p>请参考3.2.2.2筛选会议目标酒店</p>
            <p>7、填写备注信息</p>
            <img src="../img/help/47.png" alt="">
            <p>8、复制会议</p>
            <img src="../img/help/46.png" alt="">
            <p>该功能可复制历史会议信息进行快捷操作；在搜索框中输入会议名称并选择历史会议；选择会议后，页面中的会议类型、竞标类型、竞标时间、子公司、会议需求、会议酒店、备注信息都会被自动导入，数据来源于系统已有的历史会议记录信息；</p>
            <p>9、不上传需求文档</p>
            <img src="../img/help/6.png" alt="">
            <p>勾选该“不上传需求文档”复选框，可以不上传需求文件（即可以跳过第5项）；所有需求信息在预览中进行填写；具体预览信息如下图1、图2、图3所示：</p>
            <img src="../img/help/7.png" alt="">
            <p class="center">（图1）</p>
            <img src="../img/help/8.png" alt="">
            <p class="center">（图2）</p>
            <img src="../img/help/9.png" alt="">
            <p class="center">（图3）</p>
            <h3>3.2.2.2筛选会议目标酒店</h3>
            <p>在[创建会议]页面，点击“选择会议酒店”按钮，进入［选择商家］功能页面，AZ用户可以通过两个数据库向意向酒店发送竞标邀请：1、直采酒店（AZPCH酒店），2、系统酒店（会唐提供的补充酒店数据库，内置医药常用酒店目录）。如下图所示：</p>
            <img src="../img/help/10.png" alt="">
            <h3>3.2.2.3确认会议目标酒店</h3>
            <p>AZ用户如确认检索到的酒店可以满足举办会议的要求，可以点击酒店信息右侧 “加入意向商家”按钮，此酒店则做为会议目标酒店被加入询单车。若已选好意向商家可以点击“选好了”按钮，完成会议目标酒店的选择；如下图所示：</p>
            <img src="../img/help/11.png" alt="">
            <p>用户还可通过“继续添加”按钮，进行意向酒店的选择；</p>
            <h3>预览／修改需求／发送会议需求</h3>
            <p>AZ用户填写完成会议需求后，点击“下一步，预览”按钮，系统会进入预览页面。预览页面如下图所示：</p>
            <img src="../img/help/12.png" alt="">
            <p class="center">（图一）</p>
            <p>在图一所示页面中，可以查看会议基本信息，已选择的酒店，会议资料；点击“查看会议Excel数据”新标签中显示上传的Excel需求文件；如下图所示：</p>
            <img src="../img/help/13.png" alt="">
            <p class="center">查看Excel数据</p>
            <img src="../img/help/14.png" alt="">
            <p class="center">（图二）</p>
            <p>查看会议基本信息（见图二），并可以进行增加，编辑和删除操作；</p>
            <ul>
                <li>1.增加模块:会议时间（日期格式为xxxx年xx月xx日），其他信息，备注为必填项；</li>
                <li>2.修改信息:会议时间格式如下：xxxx年xx月xx日 或者xxxx年xx月xx日 （全天/上午/下午） 如：2017年3月5日 或者 2017年3月6日 全天 （2017年3月6日与全天之间必须有一空格）</li>
                <li>3.删除模块：其中每个模块至少保留一条。查看餐饮基本信息（见图二），并可以进行增加，编辑和删除操作；</li>
                <li>4.增加模块:餐饮日期（住宿日期格式为xxxx年xx月xx日），用餐安排，用餐方式和用餐人数为必填项；</li>
                <li>5.修改信息: 使用时间，用餐安排和用餐方式不可修改；用餐人数可以进行修改。</li>
                <li>6.删除模块：其中每个模块至少保留一条。</li>
            </ul>
            <img src="../img/help/15.png" alt="">
            <p class="center">（图三）</p>
            <p>查看住宿基本信息（见图三），并可以进行增加，编辑和删除操作；</p>
            <ul>
                <li>1.增加模块:住宿日期（住宿日期格式为xxxx年xx月xx日），房间类型，房间数据量为必填项；</li>
                <li>2.修改信息:住宿日期／房间类型不可以修改；房间数量/备注项可以进行修改。</li>
                <li>3.删除模块：其中每个模块至少保留一条。</li>
            </ul>
            <p>信息修改完成后，需要点击“确定”按钮，确认信息修改；否则修改不会生效。确认信息无误后，点击“提交会议并发送需求”按钮，系统把会议需求发送给目标酒店。如下图所示：</p>
            <img src="../img/help/16.png" alt="">
            <p>点击“返回会议管理”按钮，返回到会议管理列表；</p>
            <h2 id="a11">3.3会议管理</h2>
            <h3 id="a12">3.3.1功能描述</h3>
            <p>AZ用户可以在［会议管理］功能模块筛选会议列表，查看会议信息、修改竞标时间、查看需求Excel、比对酒店方报价、导出对比报价、查看报价明细、以及导出报价、合并竞标、合并结果导出等。</p>
            <h3 id="a13">3.3.2会议状态</h3>
            <p>即将开始：是指竞标开始时间晚于当前时间。</p>
            <p>竞标中： 是指当前时间处于竞标开始时间之后晚于竞标结束时间。</p>
            <p>竞标结束：是指当前时间晚于竞标结束时间。防止抄底的机制, 竞标结束前10分钟之内，竞标结束时间自动延长10分钟。</p>
            <p>竞标暂停：是指报价处于暂停状态。</p>
            <p>会议关闭：是指用户将会议关闭。</p>
            <h3 id="a14">3.3.3操作流程</h3>
            <h3>3.3.3.1筛选会议列表</h3>
            <p>AZ用户可以在［会议管理］页面，通过会议名称、编号、会议种类、会议开始时间、竞标开始时间和会议状态进行筛选。如下图所示：</p>
            <img src="../img/help/17.png" alt="">
            <h3>3.3.3.2关闭会议</h3>
            <p>AZ用户可以在［会议管理］页面，通过点击操作 “关闭”，该会议状态变为：会议关闭；如下图所示：</p>
            <img src="../img/help/18.png" alt="">
            <h3>3.3.3.3邀请监管</h3>
            <p>AZ用户可以在［会议管理］页面，通过操作“邀请监管”邀请AZ用户（除了自己和超管以外用户）进行会议监管；邀请后该会议将会出现在被邀请者的会议管理列表中。如下图所示：</p>
            <img src="../img/help/19.png" alt="">
            <p>用户点击“邀请管理”弹出“邀请监管”窗口，如下图所示</p>
            <img src="../img/help/20.png" alt="">
            <p>用户勾选用户复选框，点击“确定”按钮，完成监管邀请，登录被邀请账号，在会议管理列表中显示邀请监管的会议；</p>
            <h3>3.3.3.4合并竞标</h3>
            <p>当多个会议需要在同一个场地举办的时候，AZ用户可在［会议管理］页面，勾选“会议”复选框，点击“合并竞标”按钮，进入合并竞标页面。</p>
            <img src="../img/help/21.png" alt="">
            <p>合并后，如下图所示：</p>
            <img src="../img/help/22.png" alt="">
            <p>AZ用户在［合并竞标］页面，点击底部“导出Excel”按钮；将合并竞标以Excel形式导出到电脑中，电脑中打开Excel必须要点击“启用编辑”按钮，方可进行操作：</p>
            <img src="../img/help/23.png" alt="">
            <h3>3.3.3.5通知酒店方参与合并竞标</h3>
            <p>AZ用户在［会议管理］页面，勾选符合规则的“会议”复选框，点击“通知合并竞标”按钮；发送短信通知到场地方。短信内容：‘A会议，B会议，C会议进行了合并竞标，回复报价时，请谨慎报价’。</p>
            <h3>3.3.3.6查看会议</h3>
            <p>AZ用户在［会议管理］页面，点击“查看会议”，进入会议详情页。如下图所示：</p>
            <img src="../img/help/24.png" alt="">
            <p>会议详情页面主要分为三部分:</p>
            <ul>
                <li>1.会议详情主要包括：会议编号、子公司、活动名称、活动类型、举办地点、时间、负责人、手机、询单商家、报价数量、总参会人数、总预算费用及查看Excel需求；</li>
                <li>2.竞标时间信息主要包括：开始时间、结束时间、报价的开启与暂停；</li>
                <li>3.竞标管理信息主要包括：目标商家名称、是否为协议酒店、报价金额、报价次数、报价人、联系方式、报价时间、状态和操作 ；</li>
            </ul>
            <h3>3.3.3.7查看需求Excel</h3>
            <p>AZ用户在［会议详情］页面，点击“查看Excel”进入会议需求表。如下图所示： </p>
            <img src="../img/help/25.png" alt="">
            <h3>3.3.3.8查看详情</h3>
            <p>AZ用户在［会议详情］页面，点击“查看详情”按钮进入会议需求详情表页面。包括会议信息，基本资料，餐饮需求，住宿需求会议要求。具体如下图所示：</p>
            <img src="../img/help/26.png" alt="">
            <p>该详细信息与创建会议预览信息一致；</p>
            <h3>3.3.3.9竞标中添加意向酒店</h3>
            <p>AZ用户在［会议详情］页面，点击“查看详情”按钮进入会议需求详情表页面。具体如下下图所示：</p>
            <img src="../img/help/27.png" alt="">
            <h3>3.3.3.10修改竞标时间/报价开启关闭</h3>
            <p>AZ用户在［会议详情］页面，进入会议详情页。如下图所示：</p>
            <img src="../img/help/28.png" alt="">
            <p>用户修改开始时间和结束时间，点击“修改”按钮，完成竞标时间的修改。</p>
            <img src="../img/help/29.png" alt="">
            <p>报价处于开启状态，可以点击“绿色”按钮，暂停报价。</p>
            <img src="../img/help/30.png" alt="">
            <p>报价处于暂停状态，可以点击按钮，启动报价。</p>
            <h3>竞价排行</h3>
            <p>AZ用户在Auction［会议详情］页面，有场地方进行报价后，可以查看到竞价排行，如下图所示；</p>
            <img src="../img/help/31.png" alt="">
            <p>在竞价排行模块可以看到，场地方报价情况及排名；</p>
            <h3>3.3.3.12比对酒店方报价/导出比对报价</h3>
            <p>AZ用户在［会议详情］页面，竞标管理区进行对比报价； </p>
            <p>如下图所示：</p>
            <img src="../img/help/32.png" alt="">
            <p>竞标管理模块，可以“议价”，点击酒店对应的”议价“按钮后，酒店可以更新报价；点击“结束议价”按钮，酒店不可以更新报价。用户勾选已报价的酒店，点击“对比报价“按钮，进入对比报价页面SRF；对比报价页面SRF如下图所示：</p>
            <img src="../img/help/33.png" alt="">
            <p>AZ用户点击底部“导出Excel”按钮；将合并竞标以Excel形式导出到电脑中，电脑中打开Excel必须要点击“启用编辑”按钮，方可进行操作：</p>
            <img src="../img/help/34.png" alt="">
            <h3>3.3.3.13报价明细/导出报价单</h3>
            <p>AZ用户在［会议详情］页面，点击“竞标管理”操作项“报价明细”</p>
            <img src="../img/help/35.png" alt="">
            <p>进入报价明细页面，如下图1-4所示：</p>
            <img src="../img/help/36.png" alt="">
            <p class="center" （图1）></p>
            <img src="../img/help/37.png" alt="">
            <p class="center" （图2）></p>
            <img src="../img/help/38.png" alt="">
            <p class="center" （图3）></p>
            <img src="../img/help/39.png" alt="">
            <p class="center" （图4）></p>
            <p>AZ用户在［报价详情］页面，点击底部“导出报价单”按钮；将报价单以Excel形式导出到电脑中;</p>
            <img src="../img/help/40.png" alt="">
            <h2 id="a15">3.4用户管理</h2>
            <h3 id="a16">3.4.1功能描述</h3>
            <p>AZ超级管理员可以在［用户管理］功能模块查看用户信息、创建用户、更新用户信息、删除用户等操作。</p>
            <h3 id="a17">3.4.2操作流程</h3>
            <h3>3.4.2.1创建用户</h3>
            <p>点击导航区的“用户管理”菜单，右侧功能区显示用户列表；点击右上角“添加用户”按钮，如下图所示：</p>
            <img src="../img/help/41.png" alt="">
            <p>进入添加用户页面；输入用户中文名称，英文名称，部门，Email，手机号码，工作电话，角色，工号，企业账号密码信息，点击“保存”按钮；</p>
            <p><b>角色权限说明:</b></p>
            <p>超级管理员: 可以添加用户，查看所有的会议；</p>
            <p>采购经理: 可以查看自己创建的会议；</p>
            <p>采购员：可以查看自己创建的会议；</p>
            <h3>3.4.2.2更新用户</h3>
            <p>点击导航区的“用户管理”菜单，右侧功能区显示用户列表；点击某账户后的“编辑”按钮。如下图所示：</p>
            <img src="../img/help/42.png" alt="">
            <p>进入更新用户信息页面，根据需要修改信息项，最后点击“更新”按钮；</p>
            <h3>删除用户</h3>
            <p>点击导航区的“用户管理”菜单，右侧功能区显示用户列表；点击某账户后的“查看”按钮。如下图所示：</p>
            <img src="../img/help/43.png" alt="">
            <p>进入用户信息页面，点击红色“删除”按钮；</p>
            <p>如下图所示</p>
            <img src="../img/help/44.png" alt="">
            <p>删除成功；</p>
            <h1 id="a18">4、联系我们</h1>
            <h2 id="a19">4.1联系我们</h2>
            <p>会唐AZ项目组联系人如下，若有疑问请与以下人员联系:</p>
            <table>
                <tr>
                    <td>姓名</td>
                    <td>座机</td>
                    <td>电话</td>
                    <td>邮箱</td>
                </tr>
                <tr>
                    <td>侯瑞</td>
                    <td>010-57457499</td>
                    <td>15810783823</td>
                    <td>rui_hou@eventown.com</td>
                </tr>
                <tr>
                    <td>黄本保</td>
                    <td>010-57457488</td>
                    <td>18624933409</td>
                    <td>benbao_huang@eventown.com</td>
                </tr>
                <tr>
                    <td>关雅卓(技术)</td>
                    <td></td>
                    <td>15710061246</td>
                    <td>yazhuo_guan@eventown.com</td>
                </tr>
            </table>
            <h1 id="a20">5、常见错误提示</h1>
            <h2 id="a21">5.1.1常见错误原因：</h2>
            <p>Excel文件与系统版本不一致，报错信息如下：</p>
            <img src="../img/help/45.png" alt="">
            <p>请对比并更新为AZ最新统一模板。</p>
        </div>
        <div class="main-r">
            <ul>
                <li>
                    <dl>
                        <dt><a href="#a1">引言</a></dt>
                        <dd><a href="#a2">产品名称</a></dd>
                        <dd><a href="#a3">产品版本</a></dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt><a href="#a4">系统概述</a></dt>
                        <dd><a href="#a5">功能列表</a></dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt><a href="#a6">功能详细介绍</a></dt>
                        <dd><a href="#a7">系统登录</a></dd>
                        <dd><a href="#a8">创建会议</a></dd>
                        <dd><a href="#a9">功能描述</a></dd>
                        <dd><a href="#a10">操作流程</a></dd>
                        <dd><a href="#a11">会议管理</a></dd>
                        <dd><a href="#a12">功能描述</a></dd>
                        <dd><a href="#a13">会议状态</a></dd>
                        <dd><a href="#a14">操作流程</a></dd>
                        <dd><a href="#a15">用户管理</a></dd>
                        <dd><a href="#a16">功能描述</a></dd>
                        <dd><a href="#a17">操作流程</a></dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt><a href="#a18">联系我们</a></dt>
                        <dd><a href="#a19">联系我们</a></dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt><a href="#a20">常见错误提示</a></dt>
                        <dd><a href="#a21">常见错误原因</a></dd>
                    </dl>
                </li>
            </ul>
        </div>
    </div>