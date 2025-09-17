# DIY Meta Tag

一个简单而强大的WordPress插件，用于管理文章和页面的自定义meta标签。非常适合SEO优化和添加自定义元数据。

## 🌟 主要功能

- **简单易用**：在文章/页面编辑器中提供简洁的界面
- **多种标签类型**：支持 `name` 和 `property` 类型的meta标签
- **SEO友好**：完美适用于添加SEO相关的meta标签
- **社交媒体就绪**：添加Open Graph和Twitter Card标签
- **干净输出**：在网站head部分正确格式化meta标签
- **无数据库膨胀**：使用WordPress文章meta高效存储
- **翻译就绪**：完全可翻译，包含语言文件

## 📋 适用场景

- SEO优化
- 社交媒体分享的Open Graph标签
- Twitter Card标签
- 自定义分析标签
- Schema.org标记
- 任何自定义meta标签需求

## 💻 安装

### 方法一：WordPress后台安装
1. 下载插件zip文件
2. 登录WordPress后台
3. 进入 `插件 > 安装插件`
4. 点击 `上传插件`
5. 选择zip文件并安装
6. 激活插件

### 方法二：手动安装
1. 下载并解压插件
2. 将 `diy-meta-tag` 文件夹上传到 `/wp-content/plugins/` 目录
3. 在WordPress后台激活插件

## 🚀 使用方法

1. **编辑文章或页面**：导航到任意文章或页面的编辑界面
2. **找到Meta Tag Manager**：在侧边栏查找"Meta Tag Manager"框
3. **添加Meta标签**：
   - 选择标签类型（name 或 property）
   - 输入meta标签键名（如："description"、"og:title"）
   - 输入标签值
4. **添加更多标签**：点击"添加Meta标签"添加更多标签
5. **删除标签**：点击任意标签旁的"删除"按钮
6. **保存**：更新或发布文章/页面以保存meta标签

Meta标签将自动出现在相应文章和页面的 `<head>` 部分。

## 📖 常用示例

### SEO标签
```html
<meta name="description" content="您的页面描述">
<meta name="keywords" content="关键词1,关键词2,关键词3">
```

### Open Graph标签（社交媒体分享）
```html
<meta property="og:title" content="分享时显示的标题">
<meta property="og:description" content="分享时显示的描述">
<meta property="og:image" content="https://example.com/image.jpg">
```

### Twitter Card标签
```html
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Twitter分享标题">
```

## 🔧 技术要求

- **WordPress**: 5.0 或更高版本
- **PHP**: 7.4 或更高版本
- **无额外服务器要求**

## 🌍 多语言支持

插件支持多语言翻译，目前包含：
- 英语（默认）
- 中文简体（zh_CN）

## 📝 开发者信息

### 钩子和过滤器

- `diymt_head_meta_tags_pre` - 在处理前过滤meta标签
- `diymt_head_meta_tags` - 在输出前过滤最终meta标签
- `diymt_loaded` - 插件加载完成时触发的动作钩子
- `diymt_head` - meta标签输出后触发的动作钩子

### 代码标准

- 遵循WordPress编码标准
- 包含完整的安全检查
- 使用WordPress数据库API
- 包含完整的文档注释

## 🤝 贡献

欢迎贡献代码！请遵循以下步骤：

1. Fork这个仓库
2. 创建你的功能分支 (`git checkout -b feature/AmazingFeature`)
3. 提交你的更改 (`git commit -m 'Add some AmazingFeature'`)
4. 推送到分支 (`git push origin feature/AmazingFeature`)
5. 开启一个Pull Request

## 📄 许可证

本项目使用 GPLv2 或更高版本许可证。详情请见 [LICENSE](https://www.gnu.org/licenses/gpl-2.0.html) 文件。

## 🆘 支持

如果您遇到任何问题或需要帮助：

1. 检查 [Issues](https://github.com/d1-always/diy-meta-tag/issues) 页面
2. 创建新的Issue描述您的问题
3. 提供详细的错误信息和环境详情

## 📊 版本历史

### 1.0.1
- 添加了正确的卸载脚本以在删除插件时清理数据
- 添加了翻译支持和中文（zh_CN）翻译
- 改进了代码结构和文档
- 添加了WordPress.org提交的插件资源
- 增强了数据清理的安全性
- 修复了小错误并提高了稳定性

### 1.0
- 初始版本
- 基本meta标签管理功能
- 支持文章和页面
- 简单的管理界面

---

**永久免费** 🎉 本插件完全免费且将永远保持免费。没有高级版本，没有隐藏费用，没有限制。


