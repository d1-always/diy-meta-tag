# DIY Meta Tag 插件安装说明

## 📦 插件包说明

我们为您准备了两个版本的插件包：

### 1. **diy-meta-tag-v1.0.1.zip** (完整开发版)
- **大小**: ~14KB
- **包含**: 所有文件，包括开发文档和提交指南
- **适用于**: 开发者、学习参考、完整备份

### 2. **diy-meta-tag-wordpress-org.zip** (WordPress.org提交版)
- **大小**: ~11KB  
- **包含**: 纯净的插件文件，符合WordPress.org要求
- **适用于**: WordPress.org提交、生产环境安装

## 🚀 安装方法

### 方法一：WordPress后台安装
1. 登录WordPress后台
2. 进入 `插件 > 安装插件`
3. 点击 `上传插件`
4. 选择 `diy-meta-tag-wordpress-org.zip` 文件
5. 点击 `现在安装`
6. 安装完成后点击 `启用插件`

### 方法二：FTP上传安装
1. 解压 `diy-meta-tag-wordpress-org.zip`
2. 通过FTP将 `diy-meta-tag` 文件夹上传到 `/wp-content/plugins/` 目录
3. 在WordPress后台 `插件` 页面找到并启用插件

## ✨ 使用方法

1. **编辑文章或页面**
2. **找到右侧的"Meta Tag Manager"框**
3. **添加meta标签**:
   - 选择类型 (name 或 property)
   - 输入键名 (如: description, og:title)
   - 输入值
4. **保存文章**

## 🔧 常用Meta标签示例

### SEO标签
```
类型: name
键: description  
值: 您的页面描述

类型: name
键: keywords
值: 关键词1,关键词2,关键词3
```

### Open Graph标签 (社交媒体分享)
```
类型: property
键: og:title
值: 分享时显示的标题

类型: property  
键: og:description
值: 分享时显示的描述

类型: property
键: og:image
值: https://example.com/image.jpg
```

### Twitter Card标签
```
类型: name
键: twitter:card
值: summary_large_image

类型: name
键: twitter:title  
值: Twitter分享标题
```

## 📋 插件特点

- ✅ **完全免费** - 所有功能永久免费
- ✅ **轻量级** - 不影响网站性能
- ✅ **易于使用** - 简洁的管理界面
- ✅ **安全可靠** - 符合WordPress安全标准
- ✅ **多语言支持** - 支持中英文
- ✅ **兼容性好** - 支持WordPress 5.0+

## 🆘 技术支持

如果您在使用过程中遇到任何问题，请检查：

1. **WordPress版本**: 需要5.0或更高版本
2. **PHP版本**: 需要7.4或更高版本  
3. **插件冲突**: 尝试停用其他插件测试
4. **主题兼容性**: 确保主题正确调用wp_head()

## 📝 版本信息

- **当前版本**: 1.0.1
- **兼容WordPress**: 5.0 - 6.7
- **最低PHP要求**: 7.4
- **许可证**: GPLv2 or later

---

**祝您使用愉快！** 🎉