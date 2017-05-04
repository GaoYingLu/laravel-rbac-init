SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rbac`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin_password_resets`
--

CREATE TABLE IF NOT EXISTS `admin_password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `is_super` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否超级管理员',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `email`, `password`, `is_super`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$GBKiY/ngDVpe1iHwlTem3e0fbNrnv1sRLGcj4wT1isK0gbzY4oQoC', 1, 'aot2y8pFRyurjUWQs2JiH3QWZJcSTepfsgB1qXPwtXST8inqnjdTwilMSaa4', '2016-02-23 02:44:26', '2016-02-23 02:44:26');

-- --------------------------------------------------------

--
-- 表的结构 `admin_user_role`
--

CREATE TABLE IF NOT EXISTS `admin_user_role` (
  `admin_user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `admin_user_role`
--

INSERT INTO `admin_user_role` (`admin_user_id`, `role_id`) VALUES
(1, 10);

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_01_18_071439_create_admin_users', 1),
('2016_01_18_071720_create_admin_password_resets_table', 1),
('2016_01_23_031442_entrust_base', 1),
('2016_01_23_031518_entrust_pivot_admin_user_role', 1);

-- --------------------------------------------------------

--
-- 表的结构 `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL,
  `fid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '菜单父ID',
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '图标class',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_menu` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否作为菜单显示,[1|0]',
  `sort` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `permissions`
--

INSERT INTO `permissions` (`id`, `fid`, `icon`, `name`, `display_name`, `description`, `is_menu`, `sort`, `created_at`, `updated_at`)
VALUES
	(20, 0, 'edit', '#-1456129983', '系统设置', '', 1, 100, '2016-02-22 00:33:03', '2016-02-22 00:33:03'),
	(21, 20, '', 'admin.admin_user.index', '用户权限', '查看后台用户列表', 1, 0, '2016-02-17 23:56:26', '2016-02-17 23:56:26'),
	(22, 20, '', 'admin.admin_user.create', '创建后台用户', '页面', 0, 0, '2016-02-22 19:48:18', '2016-02-22 19:48:18'),
	(35, 0, 'home', 'admin.home', 'Dashboard', '后台首页', 1, 0, '2016-02-22 00:32:40', '2016-02-22 00:32:40'),
	(37, 36, '', 'admin.blog.index', '博客列表', '', 1, 0, '2016-02-22 01:15:48', '2016-02-22 01:15:48'),
	(38, 20, '', 'admin.admin_user.store', '保存新建后台用户', '操作', 0, 0, '2016-02-22 19:48:52', '2016-02-22 19:48:52'),
	(39, 20, '', 'admin.admin_user.destroy', '删除后台用户', '操作', 0, 0, '2016-02-22 19:49:09', '2016-02-22 19:49:09'),
	(40, 20, '', 'admin.admin_user.destory.all', '批量后台用户删除', '操作', 0, 0, '2016-02-22 20:01:01', '2016-02-22 20:01:01'),
	(42, 20, '', 'admin.admin_user.edit', '编辑后台用户', '页面', 0, 0, '2016-02-22 19:48:35', '2016-02-22 19:48:35'),
	(43, 20, '', 'admin.admin_user.update', '保存编辑后台用户', '操作', 0, 0, '2016-02-22 19:50:12', '2016-02-22 19:50:12'),
	(44, 20, '', 'admin.permission.index', '权限管理', '页面', 0, 0, '2016-02-22 19:51:36', '2016-02-22 19:51:36'),
	(45, 20, '', 'admin.permission.create', '新建权限', '页面', 0, 0, '2016-02-22 19:52:16', '2016-02-22 19:52:16'),
	(46, 20, '', 'admin.permission.store', '保存新建权限', '操作', 0, 0, '2016-02-22 19:52:38', '2016-02-22 19:52:38'),
	(47, 20, '', 'admin.permission.edit', '编辑权限', '页面', 0, 0, '2016-02-22 19:53:29', '2016-02-22 19:53:29'),
	(48, 20, '', 'admin.permission.update', '保存编辑权限', '操作', 0, 0, '2016-02-22 19:53:56', '2016-02-22 19:53:56'),
	(49, 20, '', 'admin.permission.destroy', '删除权限', '操作', 0, 0, '2016-02-22 19:54:27', '2016-02-22 19:54:27'),
	(50, 20, '', 'admin.permission.destory.all', '批量删除权限', '操作', 0, 0, '2016-02-22 19:55:17', '2016-02-22 19:55:17'),
	(51, 20, '', 'admin.role.index', '角色管理', '页面', 0, 0, '2016-02-22 19:56:07', '2016-02-22 19:56:07'),
	(52, 20, '', 'admin.role.create', '新建角色', '页面', 0, 0, '2016-02-22 19:56:33', '2016-02-22 19:56:33'),
	(53, 20, '', 'admin.role.store', '保存新建角色', '操作', 0, 0, '2016-02-22 19:57:26', '2016-02-22 19:57:26'),
	(54, 20, '', 'admin.role.edit', '编辑角色', '页面', 0, 0, '2016-02-22 19:58:25', '2016-02-22 19:58:25'),
	(55, 20, '', 'admin.role.update', '保存编辑角色', '操作', 0, 0, '2016-02-22 19:58:50', '2016-02-22 19:58:50'),
	(56, 20, '', 'admin.role.permissions', '角色权限设置', '', 0, 0, '2016-02-22 19:59:26', '2016-02-22 19:59:26'),
	(57, 20, '', 'admin.role.destroy', '角色删除', '操作', 0, 0, '2016-02-22 19:59:49', '2016-02-22 19:59:49'),
	(58, 20, '', 'admin.role.destory.all', '批量删除角色', '', 0, 0, '2016-02-22 20:01:58', '2016-02-22 20:01:58'),
	(59, 0, 'bars', '#-1479201461', '信息管理', '', 1, 0, '2016-11-29 23:23:57', '2016-11-15 09:17:41'),
	(60, 59, '', 'admin.article.add', '信息添加', '页面', 1, 0, '2017-02-25 07:09:42', '2016-11-15 09:18:51'),
	(61, 59, '', 'admin.article.doAddOrUpdate', '执行添加信息', '操作', 0, 0, '2017-02-25 08:02:44', '2016-11-15 09:19:13'),
	(62, 59, '', 'admin.article.index', '信息列表', '页面', 1, 1, '2017-02-25 07:10:01', '2016-11-25 07:08:49'),
	(63, 59, '', 'admin.category.index', '信息类别', '页面', 1, 0, '2017-02-25 08:02:50', '2016-11-30 09:13:56'),
	(64, 59, '', 'admin.category.doAddOrUpdate', '执行添加类别', '操作', 0, 0, '2017-02-25 08:02:47', '2016-11-30 09:14:35'),
	(65, 59, '', 'admin.article.edit', '信息编辑', '页面', 0, 0, '2017-02-25 07:10:24', '2016-12-16 03:49:34'),
	(66, 59, '', 'admin.category.edit', '编辑类别', '页面', 0, 0, '2017-02-25 08:03:35', '2016-12-16 10:26:15'),
	(67, 59, '', 'admin.article.del', '删除信息', '操作', 0, 0, '2017-02-25 07:10:18', '2016-12-17 02:35:17');

replace INTO `permissions` (`id`, `fid`, `icon`, `name`, `display_name`, `description`, `is_menu`, `sort`, `created_at`, `updated_at`)
VALUES
	(68, 59, '', 'admin.category.edit', '编辑分类', '页面', 0, 0, '2017-02-17 11:44:14', '2016-12-16 03:49:34'),
	(69, 59, '', 'admin.category.del', '删除分类', '操作', 0, 0, '2017-02-17 11:44:22', '2016-12-17 02:35:17'),
	(70, 0, 'arrows', '#-1490285282', '留言管理', '', 1, 0, '2017-03-23 16:08:02', '2017-03-23 16:08:02'),
	(71, 70, '', 'admin.msg', '列表信息', '', 1, 0, '2017-03-23 16:08:41', '2017-03-23 16:08:41'),
	(72, 70, '', 'admin.doMsg', '标记处理', '', 0, 0, '2017-03-23 16:09:01', '2017-03-23 16:09:01'),
	(73, 70, '', 'admin.delMsg', '删除留言', '', 0, 0, '2017-03-23 16:09:20', '2017-03-23 16:09:20');

-- --------------------------------------------------------

--
-- 表的结构 `permission_role`
--

CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(20, 10),
(21, 10),
(22, 10),
(35, 10),
(36, 10),
(37, 10),
(38, 10),
(39, 10),
(40, 10),
(42, 10),
(43, 10),
(44, 10),
(45, 10),
(46, 10),
(47, 10),
(48, 10),
(49, 10),
(50, 10),
(51, 10),
(52, 10),
(53, 10),
(54, 10),
(55, 10),
(56, 10),
(57, 10),
(58, 10),
(20, 12),
(21, 12),
(22, 12),
(35, 12),
(36, 12),
(37, 12);

-- --------------------------------------------------------

--
-- 表的结构 `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(10, 'administrator', '系统管理员', '', '2016-02-19 09:59:52', '2016-02-19 09:59:52'),
(12, 'test', '测试狗', '', '2016-02-19 10:00:43', '2016-02-19 10:00:43');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD KEY `admin_password_resets_email_index` (`email`),
  ADD KEY `admin_password_resets_token_index` (`token`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_users_email_unique` (`email`);

--
-- Indexes for table `admin_user_role`
--
ALTER TABLE `admin_user_role`
  ADD PRIMARY KEY (`admin_user_id`,`role_id`),
  ADD KEY `admin_user_roles_role_id_foreign` (`role_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- 限制导出的表
--

--
-- 限制表 `admin_user_role`
--
ALTER TABLE `admin_user_role`
  ADD CONSTRAINT `admin_user_roles_admin_user_id_foreign` FOREIGN KEY (`admin_user_id`) REFERENCES `admin_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `admin_user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


replace INTO `article` (`id`, `title`, `thumb_img`, `attachment`, `intro`, `keywords`, `description`, `cat_id`, `hits`, `sort`, `admin_id`, `template`, `created_at`, `updated_at`)
VALUES
	(1, '关于致胜教育', '/upload/2017-02-25/phpmyviGM.jpg', '', '致胜相信，大部分的学生和家长在选择机构时，都是在规划老师和咨询老师的承诺和保证中确定了机构。但是那些规划老师和咨询师，多以销售为主。他们最熟悉的是签约技巧，而不是“咨询和建议”。真正的咨询和建议，是要站在学生和学生背后，以学生和家庭的角度去考虑留学问题。更重要的是，要敢于说真话！致胜留学的咨询老师，都是真材实料的后期申请老师。都熟知学生的GPA和科研经历才是申请的重点，都不会随便给学生承诺。而且，致胜留学的顾问老师，在经过分析后，甚至会建议学生放弃出国留学...', '', '', 1, 6111, 0, 0, '', '2017-02-25 15:21:52', '2017-02-26 02:17:15'),
	(2, '致胜伙伴 DIY 定制服务', '', '', '美国留学申请的 DIY-STYLE', '金牌顾问一对一全程跟踪指导 超高性价比 | 010-57102661', '', 2, 6745, 0, 0, '', '2017-02-25 16:07:59', '2017-02-25 16:15:36'),
	(3, '我们的服务', '', '', '专为研究生学位申请而设计:毕达的服务体系专为增强研究生学位申请者的核心竞争力而设计;', '按申请专业分配顾问:根据学生申请专业来分配相应专业研究小组的留学顾问，专业性和针对性更强;跨地区组合式申请:学生可以同时申请多个国家，最大程度拓宽申请范围;', '申请邮箱共管:学生和留学顾问共同管理申请邮箱，扫除信息不对称和暗箱操作的一切不利影响; 专业背景竞争力提升指导:除了提供精确的实习岗位/内容、研究项目、专业技能等背景提升的建议指导外，毕达还为学生提供帮助学生实质提升软实力的服务项目，比如香港国泰君安、伦敦资产管理、华尔街资本市场实证项目等，帮助学生在申请当中脱颖而出。', 4, 8733, 0, 0, '', '2017-02-26 02:11:44', '2017-03-22 16:03:46'),
	(4, '英才服务/Service', '/upload/2017-02-26/phpuzEW1n.png', '', '是致胜留学的重点服务项目', '针对对于留学全程不熟悉或经验不足的申请者', '', 5, 5624, 0, 0, '', '2017-02-26 02:22:33', '2017-02-26 02:30:20'),
	(5, '定制服务/Service', '/upload/2017-02-26/phprxPR22.png', '', '伙伴式DIY定制服务是致胜最受欢迎的', '服务项目，对于希望省钱且有专业团队全程指导', '', 5, 1906, 0, 0, '', '2017-02-26 02:32:34', '2017-02-26 02:33:01'),
	(6, '背景提升/Service', '/upload/2017-02-26/phpXdk2aX.png', '', '一般所指的都是软背景提升', '这种说法是针对硬性成绩（GPA、TOEFL）而来', '', 5, 6381, 0, 0, '', '2017-02-26 02:34:40', '2017-02-26 02:34:57'),
	(7, '单项服务/Service', '/upload/2017-02-26/phpiDLg2l.png', '', '文书单项服务是致胜的特色服务项目', '可提供成套高端文书修改和写作特色服务', '', 5, 3504, 1, 0, '', '2017-02-26 02:50:14', '2017-02-26 02:50:53'),
	(8, '选择致胜的理由', '', '', '他们最熟悉的是签约技巧，而不是“咨询和建议”。真正的咨询和建议，是要站在学生和学生背后，以学生和家庭的角度去考虑留学问题。更重要的是，要敢于说真话！致胜留学的咨询老师，都是真材实料的后期申请老师。都熟知学生的GPA和科研经历才是申请的重点，都不会随便给学生承诺。而且，致胜留学的顾问老师，在经过分析后，甚至会建议学生放弃出国留学！因为，致胜留学杜绝做留学行业里的“庸医”和“假咨询顾问”、“假规划师”！So,对于留学来说，我们敢说真话！ ', '', '', 6, 4257, 0, 0, '', '2017-02-26 02:53:32', '2017-02-26 02:53:32'),
	(9, '冯同学 河北经贸大学 会计', '/upload/2017-02-26/phpcjdqjo.png', '', '16年的出国和杨老师与孙老师的合作很顺利。从选校定位到网申文书调理都很清晰明了，在和杨老师反复确认学校信息..', '悉尼大学', '', 7, 3561, 0, 0, '', '2017-02-26 03:27:29', '2017-02-26 03:31:59'),
	(10, '英才全程留学重点服务', '', '', '主要针对对于留学全程不熟悉或经验不足的申请者', '英才留学服务计划将留学申请的过程细分为三大阶段，共提供40多项服务内容', '', 2, 2969, 0, 0, '', '2017-02-26 10:15:44', '2017-02-26 10:15:44'),
	(11, '丁同学 天津大学 高分子材料', '/upload/2017-02-26/phpYF5AbI.png', '', '接近一年来的申请过程已经接近尾声，现在也已经拿到了UCL等英国心仪学校的offer，感谢杨晓飞老师和徐亚丽老师...', '弗吉尼亚理工', '', 7, 2710, 0, 0, '', '2017-02-26 10:22:24', '2017-02-26 10:22:24'),
	(12, '郭同学 北京大学 临床医学', '/upload/2017-02-26/phpTqbwfF.png', '', '致胜的老师真的不错，我要特别感谢杨老师，是他帮我实现了我儿时的梦想，从选校到最终收到心仪学校的录取..', '卡内基梅陇大学', '', 7, 9871, 0, 0, '', '2017-02-26 10:25:25', '2017-02-26 10:25:25'),
	(13, '姚同学 中山大学 会计', '/upload/2017-02-26/phpOYJ0Di.png', '', '回想整个申请过程，每次无论是邮件、微信还是电话基本会很快回复我，尤其在频繁申请学校的过程中这个尤为重要...', '国立大学', '', 7, 1237, 0, 0, '', '2017-02-26 10:26:58', '2017-02-26 10:29:13'),
	(14, 'Morbi convallis urna sit amet feugiat1', '', '', 'Vivamus sit amet molestie orci. Nullam porttitor porta lobortis. Mauris semper feugiat varius. Mauris nec ligula     diam. Cras ullamcorper lorem eu sapien viverra cursus. Pellentesque commodo libero eget malesuada blandit.', '', '', 8, 6157, 0, 0, '', '2017-03-22 15:21:42', '2017-03-22 23:30:09'),
	(15, 'Is urna sit amet feugiatMorbi convalli', '', '', 'Vivamus sit amet molestie orci. Nullam porttitor porta lobortis. Mauris semper feugiat varius. Mauris nec ligula     diam. Cras ullamcorper lorem eu sapien viverra cursus. Pellentesque commodo libero eget malesuada blandit.', '', '', 8, 6157, 0, 0, '', '2017-03-22 15:21:42', '2017-03-22 23:30:11'),
	(16, '吴思晗 | Selina Wu', '', '', '6年擅长国家：美国', '致胜留学导师，丰富的留学申请经验，擅长中高端留学申请。吴老师会通过学生切身的特点来提高学生的申请优势。机智幽默的语言能够准确地挖掘学生身上的亮点和优势，从而为学生的申请之旅保驾护航。', '', 9, 3924, 0, 0, '', '2017-03-22 15:36:46', '2017-03-22 23:41:12'),
	(17, '吴宜璘 | David Wu', '', '', '6年 擅长国家：美国本科、研究生', '作为致胜首席金牌顾问的吴宜璘老师，曾就读于国内2+2大学。在美国奥本大学(简称AU)交换两年，并在波士顿大学进修市场管理研究生。吴老师熟知美国风土人情，并曾在此期间担任过国际招生办公室招生助理', '', 9, 5127, 0, 0, '', '2017-03-22 15:37:28', '2017-03-22 23:41:09'),
	(18, '杜冬蕊 | Dudu', '', '', '6年擅长国家：美国本科、研究生', '杜冬蕊老师是一位资深的海归派留学顾问，2010年在欧洲瑞典高校就读工商企业管理专业，并在美国南加州大学进修金融学研究生，并辅修了金融心理学。2010-2012年杜老师精心研究美国申请文书的构建。', '', 9, 5127, 0, 0, '', '2017-03-22 15:38:00', '2017-03-22 23:41:14'),
	(19, '杨晓飞 | Paco Yang', '', '', '8年  擅长国家：美国本科、研究生', '杨老师是致胜留学中，可以兼顾后期文案写作的老师，曾在政府部门工作多年，有着沉稳中不失犀利的写作技巧。可以深入分析学生的自身经历，找到与所申请专业完全贴合的申请理由。', '', 9, 5127, 0, 0, '', '2017-03-22 15:38:59', '2017-03-22 23:41:19'),
	(20, '毕达服务', '', '', '毕达的服务体系专为增强研究生学位申请者的核心竞争力而设计。与着眼于申请手续工作的一般留学服务所不同，毕达留学在服务过程中强调通过帮助申请人提升学术/职业素养，从根本上提高申请成功率。', '', '', 10, 9866, 0, 0, '', '2017-03-22 15:52:46', '2017-03-23 15:32:31'),
	(21, '致胜文书单项服务', '', '', '文书单项服务是主要针对DIY申请人。可提供成套高端文书修改和成套高端文书写作特色服务。客户可根据自身情况，选择相应的服务模块。致胜承诺，单项定制服务，只要客户不满意，就全额退费...', '', '', 10, 9866, 0, 0, '', '2017-03-22 15:57:44', '2017-03-23 15:31:07'),
	(22, '伙伴式DIY定制服务', '', '', '伙伴式DIY定制服务是致胜最受欢迎的服务项目，对于希望省钱，希望有专业团队全程指导的客户,伙伴式DIY定制服务涵盖申请的规划、申请、签证三大阶段，客户在留学申请的所有环节都能得到指导和支持...', '', '', 10, 9866, 0, 0, '', '2017-03-22 15:58:02', '2017-03-23 15:30:03'),
	(23, '英才全程留学服务', '', '', '英才全程留学服务是致胜留学的重点服务项目，主要针对对于留学全程不熟悉或经验不足的申请者。因此，英才留学服务计划将留学申请的过程细分为三大阶段，共提供40多项服务内容...', '', '', 10, 3778, 0, 0, '', '2017-03-23 15:28:18', '2017-03-23 15:29:37'),
	(24, '联系我们', '', '', '', '', '', 1, 6588, 0, 0, '', '2017-03-23 15:39:40', '2017-03-23 15:39:40'),
	(25, '美国法学院及法学专业介绍', '/upload/2017-03-23/phpGn5UmS.jpg', '', '看了太多美国法律电影和律政剧，是不是对美国律师充满向往?但你了解美国的司法体系和法学专业吗?今天留学小编来为大家介绍美国法学院和法学专业介绍。', '', '', 11, 1277, 0, 0, '', '2017-03-23 16:21:02', '2017-03-23 16:21:02');

replace INTO `article_content` (`id`, `article_id`, `content`, `created_at`, `updated_at`)
VALUES
	(1, 1, '<p><strong>1、拒绝用嘴巴告诉学生服务有多好。致胜一直都会让学生在签约前就提前接触到后期服务老师。致胜留学也坚持要让学生在签约之前提前看到真实的服务内容，比如申请文书、 选校报告，还有规划评估报告等。致胜留学希望用最真诚的服务文件，让学生相信和选择我们。<br />\r\n2、拒绝销售人员在签约前肆无忌惮的给出豪无保障的名校承诺。<br />\r\n3、拒绝不负责任的向学生推荐那些可以拿到学费翻涌的学校。<br />\r\n4、拒绝服务不透明、不公开、不及时。申请文书与选校报告可以提前感受。</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp;对于留学机构给学生提供的服务内容来说，让学生关心的是顾问老师是否可以在规划和背景提升环节结合学生本身的情况，给出真实有效的建议。同时，更重要的是，文书老师是否可以通过文书包装让学生能得到更有效的竞争优势，帮助学生申请到名校。而致胜留学一直奉行的是货真价实的服务体验。所以，学生可以在签约前就通过参看往届学生的真实选校报告和文书，对老师的能力和思路进行判断与分析。从而在签约前就可以提前感知服务质量。</p>\r\n\r\n<p>硕士服务团队专业化、精细化、定位准确化。</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; 据统计，美国目前共有国家级大学近2000所，涵盖专业方向众多。不同专业方向的院系录取委员会对于申请人的评判标准差异巨大。致胜留学认为只有针对不同的专业方向，提供更精细的服务，才能做到有的放矢。目前，致胜留学已经将国内申请人数较多的专业进行细分，划分出工科、商科、法律、博士、公共管理与MBA，共五大类别。针对具体的专业，致胜留学会组建专业性强的团队，所以能够提供更加专业的申请服务。</p>\r\n\r\n<p><strong>本科服务团队定制化、精细化、系统化。</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; 据统计，1996年哈佛大学在招生中拒绝了165个SAT满分的&ldquo;高考状元&rdquo;，2009年普林斯顿大学又拒绝了4000名全A学生，可见分数不是美国名校的录取标准。美国大学的录取标准：成绩、活动背景、申请缺一不可，但大多数中国大陆学生除了成绩之外，课外活动和申请两方面都是缺失的，这与美国大学的录取标准相差甚远，所以频频出现高分考生甚至高考状元被美国名校拒绝录取的案例。并且从2016年开始，美国针对本科录取的考察方式，正在逐步的改革。更加关注学生的高中学习经历，很多学生高中时段的经历都要记录在申请系统中。因此，致胜留学认为针对高中生的申请而言，提早规划，系统的针对学生的一两项特点进行系统化的提升和发展，会非常有利于学生的申请。也更容易获得美国校方的认可。</p>\r\n\r\n<p><strong>透明+确认=双重放心保证。</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; 你一定不想交了一大笔钱，却对申请进展一无所知进不了申请邮箱，看不到文书材料，甚至连学校申请是否提交了也不知道。所以，致胜为你提供了极其便利的申请工作监督手段：你可以与咨询师共享申请账号，你可以随时翻阅自己的文书稿件，你可以第一时间知道学校的申请进度。为了使你彻底放心，我们会在选校、文书、申请、录取等所有核心环节征求你的书面认可，确保你真正满意我们的工作，全面保障你的利益。</p>\r\n\r\n<p><strong>随时适应客户需求变化。</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; 你可能暂时不知道自己想要什么，所以我们不急于一开始就要求你必须定下明确的专业，明确的国家，甚至是明确的学校。我们鼓励你花时间探索和调整自己的需求，同时我们的服务将紧随着你的需求而变化。我们提供跨地区多专业的组合式申请解决方案，我们甚至不限制你申请学校的数量。所有这些，都是希望能最大程度地帮助你从全球教育资源中找到最适合你、最令你满意的学习机会。</p>\r\n\r\n<p><strong>非工作时段服务支持保障。</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; 的确，我们的咨询师也有睡觉的时间，但我们不会以此为借口而耽误你的申请。只要有必要，即使是在深夜，我们仍乐意为你提供服务支持。除了工作电话，致胜咨询师都会向客户公开私人联系电话，确保在非工作时段仍能为你提供服务支持。</p>\r\n\r\n<p><strong>用数据说话的研究型服务团队。</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; 没有大量数据支持的留学申请就像是在拿自己做试验品。你当然可以花时间自己搜集信息，但你也可以利用致胜留学系统化的数据库资源来为你节省时间。我们会定期整理各大留学论坛的录取案例，向学校和在读学生了解各学科的招生动态，并组织专业人员撰写《专业申请攻略》。通过分析数以万计的录取数据和数百所热门学校的招生资料，我们能够有效把握不同研究生学位项目的最新申请趋势及申请特点，从而帮助你更准确地规避申请风险，提高成功率。</p>\r\n\r\n<p><strong>做中国口碑最好的留学机构。</strong></p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; 2015年度，致胜留学的签约客户当中，50%来自于老客户的介绍和推荐。截止2015年12月，本年度签约客户当中，更是有高达60%的客户来自于老客户的介绍推荐。最新一次的客户满意度调查当中，致胜留学服务团队的签约客户满意度高达94%。我们不是最大的留学机构，但我们要做中国口碑最好的留学机构。</p>\r\n', '2017-02-25 15:21:52', '2017-03-22 15:20:05'),
	(2, 2, '', '2017-02-25 16:07:59', '2017-02-25 16:11:55'),
	(3, 3, '', '2017-02-26 02:11:44', '2017-03-22 16:03:46'),
	(4, 4, '', '2017-02-26 02:22:33', '2017-02-26 02:30:20'),
	(5, 5, '', '2017-02-26 02:32:34', '2017-02-26 02:32:34'),
	(6, 6, '', '2017-02-26 02:34:40', '2017-02-26 02:34:40'),
	(7, 7, '', '2017-02-26 02:50:14', '2017-02-26 02:50:14'),
	(8, 8, '致胜相信，大部分的学生和家长在选择机构时，都是在规划老师和咨询老师的承诺和保证中确定了机构。 但是那些规划老师和咨询师，多以销售为主。\r\n', '2017-02-26 02:53:32', '2017-02-26 03:23:57'),
	(9, 9, '<p>&nbsp; &nbsp; &nbsp; 16年的出国和杨老师与孙老师的合作很顺利。从选校定位到网申文书调理都很清晰明了，在和杨老师反复确认学校信息又与文书老师多次修改文书的过程中，让我在不断研究修改中更了解学校的文化，所选专业的前景以及自己兴趣所在和未来的职业规划。留学是一个漫长而又艰辛的过程，也是不断探索与自我发现的过程。感谢一路上有家长朋友和两位老师的陪伴，希望美帝的路可以走的更长更远。</p>\r\n', '2017-02-26 03:27:29', '2017-02-26 03:27:29'),
	(10, 10, '', '2017-02-26 10:15:44', '2017-02-26 10:15:44'),
	(11, 11, '<p>接近一年来的申请过程已经接近尾声，现在也已经拿到了UCL等英国心仪学校的offer。首先想感谢的就是杨晓飞老师和徐亚丽老师。对于这个团队我的看法有一下几点：1、尽管负责我的申请团队只有两人，但在我看来这样的分配更为合理，因为它节省了很多沟通成本，不需要中间老师间接传达想法，可以直接方便的和两位老师直接沟通。2、透明度很高。在找中介之前一直担心自己的申请过程会被中介公司过多干预甚至变得被动，这个团队在整个申请过程中很透明，各个账号共享，完全不会在没有学生不知情的情况下随便操作的事情，无论是文书还是网申都会在双方协商并共同检查过后确认完成。因此我很信任这个团队。3、责任心强。这点应该是留学申请非常重要的因素。回想整个申请过程，每次无论是邮件、微信还是电话基本会很快回复我，尤其在频繁申请学校的过程中这个尤为重要，可以大大的提高效率。其次团队能够在规定时间内完成任务，不会拖延时间。还记得我的文书、简历、推荐信都反复改过很多遍，所以能够及时回复学生真的为我省下不少时间。当然整个申请需要的是双方合作完成，学生绝对要参与到整个申请过程，包括文书写作、各种文件的翻译工作、学校网申、处理学校发过来的各种邮件、宿舍申请、签证等等。最后再次感谢两位老师对我申请的协助，祝福团队越做越好，学生都能取得dream offer。</p>\r\n', '2017-02-26 10:22:24', '2017-02-26 10:22:24'),
	(12, 12, '<p>致胜的老师真的不错，我要特别感谢杨老师，是他帮我实现了我儿时的梦想，从选校到最终收到心仪学校的录取，一路走来，致胜的老师们给予了我很多的帮助。还记得当初选校的时候，因为我的情况比较特殊，所以选校的难度比别的同学都要大很多，但是杨老师总是不厌其烦地帮我选校，选校的sheet是改了一遍又一遍，即使这样，老师每次选好学校后都会跟我商量，如果我不满意的话，老师就接着帮我选，我都不知道自己改了多少次，当然在这个过程中老师也会给我提很多建议，其目的就是把我送到我喜欢的学校喜欢的专业中去。在这里我真的很感谢这些默默为我付出的人。</p>\r\n', '2017-02-26 10:25:25', '2017-02-26 10:25:25'),
	(13, 13, '<p>回想整个申请过程，每次无论是邮件、微信还是电话基本会很快回复我，尤其在频繁申请学校的过程中这个尤为重要，可以大大的提高效率。其次团队能够在规定时间内完成任务，不会拖延时间。还记得我的文书、简历、推荐信都反复改过很多遍，所以能够及时回复学生真的为我省下不少时间。当然整个申请需要的是双方合作完成，学生绝对要参与到整个申请过程，包括文书写作、各种文件的翻译工作、学校网申、处理学校发过来的各种邮件、宿舍申请、签证等等。最后再次感谢两位老师对我申请的协助，祝福团队越做越好，学生都能取得dream offer。</p>\r\n', '2017-02-26 10:26:58', '2017-02-26 10:26:58'),
	(14, 14, '', '2017-03-22 15:21:42', '2017-03-22 15:21:42'),
	(15, 16, '', '2017-03-22 15:36:46', '2017-03-22 15:36:46'),
	(16, 17, '', '2017-03-22 15:37:28', '2017-03-22 15:37:28'),
	(17, 18, '', '2017-03-22 15:38:00', '2017-03-22 15:38:00'),
	(18, 19, '', '2017-03-22 15:38:59', '2017-03-22 15:38:59'),
	(19, 20, '', '2017-03-22 15:52:46', '2017-03-22 15:52:46'),
	(20, 21, '', '2017-03-22 15:57:44', '2017-03-22 15:57:44'),
	(21, 22, '', '2017-03-22 15:58:02', '2017-03-22 15:58:02'),
	(22, 23, '', '2017-03-23 15:28:18', '2017-03-23 15:28:18'),
	(23, 24, '<p>咨询电话：010-57102661</p>\r\n\r\n<p>致胜留学官网：http://www.zhishengedu.com/</p>\r\n\r\n<p>公司地址：北京朝阳区东三环中路39号建外SOHO东区1号楼904</p>\r\n\r\n<p>北京朝阳区东三环中路39号建外SOHO东区B座2802</p>\r\n\r\n<p>北京海淀区苏州街长远天地A2座912</p>\r\n', '2017-03-23 15:39:40', '2017-03-23 15:39:40'),
	(24, 25, '<p>专业介绍</p>\r\n\r\n<p>　　美国法学院都不设本科专业，所以想读法律只能从研究生开始读起。目前美国法学院的学位可以分为三种：LL.M.，J.D.与J.S.D./S.J.D，这三种学位申请条件、录取要求都不尽相同。</p>\r\n\r\n<p>　　LL.M</p>\r\n\r\n<p>　　LL.M.是老流氓，不对，Master of Law法律硕士，时长一年左右，要求申请者本科必须是法律专业或具有法律背景，不需要LSAT成绩，适合刚毕业的中国学生申请。</p>\r\n\r\n<p>　　LL.M.又可分为General program和specialized program两种。大多数学校只提供general program，比较容易申请。少数学校会提供specialized program但需要申请者有相关的工作背景，应届生申请时没有优势。</p>\r\n\r\n<p>　　另外，有些学校比如芝加哥大学、纽约大学、宾夕法尼亚大学、杜克大学、弗吉尼亚大学等还可以接受LL.M.转JD。</p>\r\n\r\n<p>　　Juris Doctor</p>\r\n\r\n<p>　　J.D.(Juris Doctor)翻译过来是法律博士，但也不算真正意义上的博士。这个学位比较偏就业和实务方向，时长三年左右，需要LSAT成绩，不限制专业背景，申请者可以来自物理、化学、生物、会计、管理、新闻、社会学等各个专业。很多美国本土学生会选择这个学位，但对国际学生来说，签证难而且学费贵。不过JD的含金量较高，在美国的接受度也更高。</p>\r\n\r\n<p>　　J.S.D/S.J.D</p>\r\n\r\n<p>　　J.S.D./S.J.D(Doctor of Juridical Science)这个学位是真正意义上的法学博士，以学术研究为导向，适合立志从事法律研究的同学。学制3~4年，申请者通常必须提交研究计划书，之后学校会视教授是否有指导意愿以及委员会审查等决定是否许可申请者入学。</p>\r\n\r\n<p>　　就业情况</p>\r\n\r\n<p>　　LL.M.在美国的就业情况并不好，因为含金量和认可度都比不上JD，但回国的就业前景还不错，中国对LL.M.的认可度比较高，比较容易找到一份好工作。而JD学位在美国很值钱，找工作和留美都更加容易。至于读JSD或者SJD的同学，就可以考虑一直坚持学术道路，可以选择在美国的大学里任教，也可以回国内大学任教。</p>\r\n\r\n<p>　　需要提醒大家注意的一点是，美国采用的是英美法系，这和国内的大陆法系是不同的，如果学得太深回国之后也不一定适用。所以综上，如果你打算回国，那么千万不要读JD，LLM更实惠，更经济，而且LLM学的知识在中国绝对够用了。如果你打算一辈子留在美国，那么就一定要选JD。而且一般来说，只有JD才可以考美国的Bar(司法考试)，但有一些州，也允许ABA认证的LLM考该州的Bar，主要有加州和纽约州。</p>\r\n\r\n<p>　　院校推荐</p>\r\n', '2017-03-23 16:21:02', '2017-03-23 16:21:02');


replace INTO `category` (`id`, `pid`, `name`, `alias`, `sort`, `admin_id`, `intro`, `template`, `created_at`, `updated_at`)
VALUES
	(1, 0, '关于我们', 'AboutUs', 0, 1, '', 'List_1', '2017-02-25 15:17:22', '2017-02-25 15:17:22'),
	(2, 3, '首页Banner', 'Banner', 0, 1, '', 'List_1', '2017-02-25 16:06:54', '2017-02-26 02:09:02'),
	(3, 0, '首页-相关', '', 0, 1, '首页为定制显示，单独拆分', 'List_1', '2017-02-26 02:08:53', '2017-02-26 02:08:53'),
	(4, 3, '首页-Service', '', 0, 1, '首页我们的服务简介', 'List_1', '2017-02-26 02:10:08', '2017-02-26 02:10:08'),
	(5, 3, '首页-ServiceList', '', 0, 1, '首页服务分类列表', 'List_1', '2017-02-26 02:10:35', '2017-02-26 02:10:35'),
	(6, 3, '首页-选择我们', '', 0, 1, '选择致胜的理由', 'List_1', '2017-02-26 02:52:15', '2017-02-26 02:52:15'),
	(7, 0, '成功案例', 'SuccessCase', 0, 1, '成功案例', 'List_1', '2017-02-26 03:26:07', '2017-02-26 03:26:07'),
	(8, 1, '关于我们详情的列表', '', 0, 1, '', 'List_1', '2017-03-22 15:28:40', '2017-03-22 15:28:40'),
	(9, 1, '服务团队', '', 0, 1, '服务团队介绍', 'List_1', '2017-03-22 15:35:34', '2017-03-22 15:35:34'),
	(10, 0, '致胜服务', '', 0, 1, '致胜服务', 'List_1', '2017-03-22 15:52:17', '2017-03-22 15:52:17'),
	(11, 0, '留学资讯', '', 0, 1, '留学资讯的相关介绍', 'List_1', '2017-03-23 16:17:37', '2017-03-23 16:17:37');

